<?php

namespace App\Actions;

use App\Models\Timetable;

class TimetableParser
{
    public function parseFile($class, $text)
    {
        $text = str_replace(array("\r\n", "\r", "\n"), '  ', $text);
        $text = explode('  ', $text);

        $number = 0;
        $weekday = 0;

        foreach ($text as $string) {
            if ($number > 7) {
                $number = 0;
                $weekday++;
            }
            $number++;

            if ($string == '') continue;

            $s = substr($string, 3);
            $s = explode('(', rtrim($s, ')'));

            if ($s[0] != '_______') {
                $lesson = $s[0];
                $room = $s[1];

                if (iconv_strlen($room) > 5) {
                    $room1 = mb_substr($room, 0, 4);
                    $room2 = mb_substr($room, 5);
                } else {
                    unset($room1, $room2);
                }
            } else {
                $lesson = '_______';
                $room = '';
            }

            $col = Timetable::where('class_id', $class->id)
                ->where('number', $number)
                ->where('weekday', $weekday)
                ->firstOrNew();

            $col->lesson = $lesson;
            $col->class_id = $class->id;
            $col->number = $number;
            $col->weekday = $weekday;
            $col->room_1 = $room1 ?? $room;
            $col->room_2 = $room2 ?? null;

            $col->save();
        }
    }

    public function parseForm($class, $data)
    {
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

        $w = 0;
        $n = 1;
        $lesson = null;
        $room1 = null;
        $room2 = null;

        foreach ($data as $key => $value)
        {
            if (!\Str::contains($key, $weekdays[$w])) {
                $n = 1;
                $lesson = $value;
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
                $col = Timetable::where('class_id', $class->id)
                    ->where('number', $number)
                    ->where('weekday', $weekday)
                    ->firstOrNew();

                if ($lesson[0] == null) {
                    $col->delete();
                    continue;
                }

                $col->lesson = $lesson[0];
                $col->teacher_id = null; //TODO: Переделать
                $col->class_id = $class->id;
                $col->number = $number;
                $col->weekday = $weekday;
                $col->room_1 = $lesson[1];
                $col->room_2 = $lesson[2];

                $col->save();
            }
        }
    }
}
