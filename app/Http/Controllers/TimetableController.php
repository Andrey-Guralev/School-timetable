<?php

namespace App\Http\Controllers;

use App\Actions\TimetableParser;
use App\Actions\Translit;
use App\Http\Requests\StoreArchiveTimetableRequest;
use App\Http\Requests\StoreFileTimetableRequest;
use App\Http\Requests\StoreFormTimetableRequest;
use App\Models\Classes;
use App\Models\Timetable;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\throwException;
use function React\Promise\all;

class TimetableController extends Controller
{
    public function getForClass($id)
    {
        $timetable = Timetable::where('class_id', $id)->get();
        $classes = Classes::all();
        $class = Classes::find($id);

        return view('timetableForClass', compact('timetable', 'class', 'classes'));
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
        $parser->parseAndSave($class, $request->text);

        return redirect()->back();
    }

    public function storeForm(StoreFormTimetableRequest $request, $class_id): \Illuminate\Http\RedirectResponse
    {
        $col = Timetable::where('class_id', $class_id)->get();

        foreach ($col as $item) {
            $item->delete();
        }


        $data = $request->all();
        unset($data["_method"]);
        unset($data["_token"]);

        $ar = array();

        $weekdays = [
            '-0-',
            '-1-',
            '-2-',
            '-3-',
            '-4-',
            '-5-',
        ];

        foreach ($data as $key => $value) {
            static $w = 0;
            static $n = 0;
            static $lesson = null;
            static $room1 = null;
            static $room2 = null;

            if (!\Str::contains($key, $weekdays[$w])) {
                $n = 0;
                $w++;
                continue;
            }

            if (\Str::contains($key, 'lesson')) {
                $lesson = $value;
                $n++;
            }

            if (\Str::contains($key, 'room1')) {
                $room1 = $value;
            }

            if (\Str::contains($key, 'room2')) {
                $room2 = $value;
            }


            $ar[$w][$n] = [$lesson, $room1, $room2];
        }

        foreach ($ar as $weekday => $val) {
            foreach ($val as $number => $lesson) {

                $col = Timetable::where('class_id', $class_id)
                    ->where('number', $number - 1)
                    ->where('weekday', $weekday)
                    ->firstOrNew();

                if ($lesson[0] == null) {
                    $col->delete();
                    continue;
                }

                $col->lesson = $lesson[0];
                $col->teacher_id = null; //TODO: Переделать
                $col->class_id = $class_id;
                $col->number = $number - 1;
                $col->weekday = $weekday;
                $col->room_1 = $lesson[1];
                $col->room_2 = $lesson[2];

                $col->save();
            }
        }

        return redirect()->back();
    }

    public function storeArchive(StoreArchiveTimetableRequest $request)
    {
        $zip = new \ZipArchive();
        $res = $zip->open($request->archive);


        if ($res == true) {

//            $dirName = explode('/', $zip->getNameIndex(0))[0];


            if ($zip->numFiles > 3) {
                \Storage::makeDirectory('/tt');

                $zip->extractTo('../storage/app/tt/');
                $zip->close();
            } else {

                $zip->extractTo('../storage/app/');
                $zip->close();
            }
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

            $parser->parseAndSave($class, $text);
        }

        \Storage::deleteDirectory($dirName);

        if (!empty($unknown)) {
            $unknown = json_encode($unknown);
        } else {
            $unknown = null;
        }

        return response($unknown, 200);
    }

}
