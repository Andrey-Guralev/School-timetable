<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileTimetableRequest;
use App\Http\Requests\StoreFormTimetableRequest;
use App\Models\Classes;
use App\Models\Timetable;
use App\Http\Requests\UpdateTimetableRequest;
use Cassandra\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Collection;

class TimetableController extends Controller
{
    public function edit() {
        $classes = Classes::all()->sortByDesc('number');

        return view('editTimetable', compact('classes'));
    }

    public function editForm($class_id) {
        $tt = Timetable::where('class_id', $class_id)->get();
        $class = Classes::find($class_id);

        return view('editFormTimetable', compact('tt', 'class'));
    }

    public function storeFile(StoreFileTimetableRequest $request, $class_id)
    {
        $col = Timetable::where('class_id', $class_id)->get();

        foreach ($col as $item) {
            $item->delete();
        }


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

    public function storeForm(StoreFormTimetableRequest $request, $class_id)
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

        foreach ($data as $key=>$value)
        {
            static $w = 0;
            static $n = 0;
            static $lesson = null;
            static $room1 = null;
            static $room2 = null;

            if (!\Str::contains($key, $weekdays[$w])) {
                $n = 0;
                $w++;
            }

            if(\Str::contains($key, 'lesson')) {
                $lesson = $value;
                $n++;
            }

            if(\Str::contains($key, 'room1')) {
                $room1 = $value;
            }

            if(\Str::contains($key, 'room2')) {
                $room2 = $value;
            }
            $ar[$w][$n] = [$lesson, $room1, $room2];
        }

        foreach ($ar as $weekday=>$val) {
            foreach ($val as $number=>$lesson) {

                $col = Timetable::where('class_id', $class_id)->where('number', $number-1)->where('weekday', $weekday)->first();

                if (!$col)
                {
                    $col = new Timetable();
                }

                if ($lesson[0] == null ) {
                    $col->delete();
                    continue;
                }

                $col->lesson        = $lesson[0];
                $col->teacher_id    = 1; //TODO: Переделать
                $col->class_id      = $class_id;
                $col->number        = $number-1;
                $col->weekday       = $weekday;
                $col->room_1        = $lesson[1];
                $col->room_2        = $lesson[2];

                $col->save();
            }
        }

        return redirect()->back();
    }

}
