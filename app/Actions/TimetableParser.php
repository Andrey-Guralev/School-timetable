<?php

namespace App\Actions;

use App\Models\Timetable;

class TimetableParser
{
    public function parseAndSave($class, $text)
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
}
