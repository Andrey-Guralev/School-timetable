<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileTimetableRequest;
use App\Http\Requests\StoreFormTimetableRequest;
use App\Models\Classes;
use App\Models\Timetable;
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

    public function edit() {
        $classes = Classes::all()->sortByDesc('number');

        return view('admin.timetable.editTimetable', compact('classes'));
    }

    public function editForm($class_id) {
        $tt = Timetable::where('class_id', $class_id)->get();
        $class = Classes::find($class_id);

        return view('admin.timetable.editFormTimetable', compact('tt', 'class'));
    }

    public function storeFile(StoreFileTimetableRequest $request, $class_id): \Illuminate\Http\RedirectResponse
    {
        $col = Timetable::where('class_id', $class_id)->get();
        foreach ($col as $item) { $item->delete(); }

        $originText = $request->text;
        $text = str_replace(array("\r\n", "\r", "\n"), '  ', $originText);
        $text = explode('  ' ,$text);

        $number = 0;
        $weekday = 0;

        foreach ($text as $string)
        {
            if ($number > 7)
            {
                $number = 0;
                $weekday++;
            }
            $number++;

            if ($string == '') continue;

            $s = substr($string, 3);
            $s = explode('(', rtrim($s, ')'));

            if ($s[0] != '_______')
            {
                $lesson = $s[0];
                $room = $s[1];

                if(iconv_strlen($room) > 5)
                {
                    $room1 = mb_substr($room, 0, 4);
                    $room2 = mb_substr($room, 5);
                }
                else
                {
                    unset($room1, $room2);
                }
            }
            else
            {
                $lesson = '_______';
                $room = '';
            }

            $col = Timetable::where('class_id', $class_id)
                ->where('number', $number)
                ->where('weekday', $weekday)
                ->firstOrNew();

                $col->lesson        = $lesson;
                $col->class_id      = $class_id;
                $col->number        = $number;
                $col->weekday       = $weekday;
                $col->room_1        = $room1 ?? $room;
                $col->room_2        = $room2 ?? null;

                $col->save();

        }
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
                continue;
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

                $col = Timetable::where('class_id', $class_id)
                    ->where('number', $number-1)
                    ->where('weekday', $weekday)
                    ->firstOrNew();

                if ($lesson[0] == null ) {
                    $col->delete();
                    continue;
                }

                $col->lesson        = $lesson[0];
                $col->teacher_id    = null; //TODO: Переделать
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
