<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileTimetableRequest;
use App\Models\Classes;
use App\Models\Timetable;
use App\Http\Requests\UpdateTimetableRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Collection;

class TimetableController extends Controller
{
    public function edit() {
        $classes = Classes::all();

        return view('editTimetable', compact('classes'));
    }

    public function editForm($class_id) {
        $tt = Timetable::where('class_id', $class_id)->get();
        $class = Classes::find($class_id);

        return view('editFormTimetable', compact('tt', 'class'));
    }

    public function storeFile(StoreFileTimetableRequest $request, $class_id)
    {
        $originText = File::get($request->file('file')); //TODO: Разобраться с кодировками

        $text = str_replace(array("\r\n", "\r", "\n"), '  ', $originText);
        $text = explode('        ', $text);
        unset($text[6]);

        $weekday = 0;

        foreach ($text as $day)
        {
            $day = explode('  ', $day);

            $number = 0;

            foreach ($day as $s)
            {
                $s = substr($s, 3);

                if (strcmp($s,'_______') != 0) {
                    $s = explode('(', $s);
                    $s[1] = rtrim($s[1], ')');

                    $lesson = $s[0];
                    $room = $s[1];
                } else {
                    $lesson = '_______';
                    $room = null;
                }

                if(iconv_strlen($room) > 4)
                {
                    $room = explode('/', $room);
                }

                $col = Timetable::where('class_id', $class_id)->where('number', $number)->where('weekday', $weekday)->first();

                if (!$col)
                {
                    $col = new Timetable();
                }

                $col->lesson        = $lesson;
                $col->teacher_id    = 1; //TODO: Переделать
                $col->class_id      = $class_id;
                $col->number        = $number;
                $col->weekday       = $weekday;
                $col->room_1        = is_array($room) ? $room[0] : $room;
                $col->room_2        = is_array($room) ? $room[1] : null;

                $col->save();

                $number++;
            }
            $weekday++;
        }
        return redirect()->back();
    }

    public function storeForm() {

    }
}
