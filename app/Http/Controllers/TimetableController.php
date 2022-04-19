<?php

namespace App\Http\Controllers;

use App\Actions\TimetableParser;
use App\Actions\Translit;
use App\Http\Requests\StoreArchiveTimetableRequest;
use App\Http\Requests\StoreFileTimetableRequest;
use App\Http\Requests\StoreFormTimetableRequest;
use App\Http\Requests\StoreXmlTimetableRequest;
use App\Jobs\TelegramTimetableUpdateNotification;
use App\Models\Classes;
use App\Models\RingSchedule;
use App\Models\TelegramSubscribers;
use App\Models\Timetable;
use Barryvdh\Debugbar\Facades\Debugbar;
use File;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;

class TimetableController extends Controller
{

    public function getById($id)
    {

    }

    public function getByCLass($class)
    {
        return Timetable::where('class_id', $class)->get();
    }

    public function get()
    {
        return Timetable::all();
    }

    public function edit()
    {
        $classes = Classes::all()->sortByDesc('number');

        return view('admin.timetable.editTimetable', compact('classes'));
    }

    public function editForm($class_id)
    {
        $tt = Timetable::where('class_id', $class_id)->get();
        $class = Classes::find($class_id);

        return view('admin.timetable.editFormTimetable', compact('tt', 'class'));
    }

    public function storeFile(StoreFileTimetableRequest $request, $class_id): \Illuminate\Http\RedirectResponse
    {
        $class = Classes::find($class_id);

        Timetable::where('class_id', $class->id)->delete();

        $parser = new TimetableParser();
        $parser->parseFile($class, $request->text);

        TelegramTimetableUpdateNotification::dispatch($class_id);

        return redirect()->back();
    }

    public function storeForm(StoreFormTimetableRequest $request, $class_id): \Illuminate\Http\RedirectResponse
    {
        Timetable::where('class_id', $class_id)->delete();

        $data = $request->all();
        $class = Classes::find($class_id);

        $parser = new TimetableParser();
        $parser->parseForm($class, $data);

        TelegramTimetableUpdateNotification::dispatch($class_id);

        return redirect()->back();
    }

    public function storeArchive(StoreArchiveTimetableRequest $request)
    {
        $zip = new \ZipArchive();
        $res = $zip->open($request->archive);


        if ($res == true) {

//            $dirName = explode('/', $zip->getNameIndex(0))[0];

            if (iconv_strlen($zip->getNameIndex(0)) > 8) {
                $zip->extractTo('../storage/app/');
            } else {
                \Storage::makeDirectory('/tt');

                $zip->extractTo('../storage/app/tt/');
            }

            $zip->close();
        } else {
            return redirect()->back();
        }
//
        $dirName = \Storage::allDirectories('')[0];
//
        $allFiles = \Storage::allFiles($dirName);
        $unknown = [];
        $parser = new TimetableParser();


        foreach ($allFiles as $file)
        {
            $text = \Storage::get($file);
            $className = explode('/', $file)[1];
            $className = explode('.', $className)[0];

            $class = Classes::where('alias', $className)->get()->first();

            if (!$class)
            {
                $className = Translit::translitInRus($className);
                $unknown[] = $className;

                continue;
            }

            if (mb_detect_encoding($text, 'utf-8', true) != true) {
                $text = mb_convert_encoding($text, 'utf-8', 'cp1251');
            }

            Timetable::where('class_id', $class->id)->delete();

            $parser->parseFile($class, $text);

            TelegramTimetableUpdateNotification::dispatch($class->id);
        }

        \Storage::deleteDirectory($dirName);

        if (!empty($unknown)) {
            $unknown = json_encode($unknown);
        } else {
            $unknown = null;
        }



        return response($unknown, 200);
    }

    public function storeXml(StoreXmlTimetableRequest $request)
    {
        $path = Storage::putFile('xmls/', $request->file('xml'));
        $xml = Storage::get($path);

        $parser = new TimetableParser();

        try {
            $parser->parseXml($xml, $request->all());
        } catch (\Throwable $throwable) {
            switch ($throwable->getCode()) {
                case 0:
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                default:
//                    return redirect()->back()->with();
            }
        }

        return redirect()->back();
        //TODO: сделать api
    }
}

