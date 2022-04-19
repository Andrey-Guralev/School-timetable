<?php

namespace App\Actions;

use App\Models\Classes;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Load;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\User;
use Exception;


class TimetableParser
{
    /**
     * @param $class
     * @param $text
     * @return void
     */
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

    /**
     * @param $class
     * @param $data
     * @return void
     */
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
                $col->teacher_id = null;
                $col->class_id = $class->id;
                $col->number = $number;
                $col->weekday = $weekday;
                $col->room_1 = $lesson[1];
                $col->room_2 = $lesson[2];

                $col->save();
            }
        }
    }


    public function parseXml($xml, $request): bool
    {
        try {
            $xml = simplexml_load_string($xml);
        }
        catch (\Throwable $throwable) {
            throw new Exception('Xml laod error' . $throwable->getMessage(), 0);
        }
        $json = json_encode($xml);
        $array = json_decode($json, true);

        //Предметы
        if (\Arr::exists($request, 'lessons'))
        {
//            Lesson::truncate();

            unset($array['subjects']['@attributes']);

            if (empty($array['subjects'])) {
                throw new Exception('Subjects is empty', 1);
            }

            foreach ($array['subjects']['subject'] as $subject) {
                $subject = $subject['@attributes'];

                $lesson = Lesson::where('name', $subject['name'])->firstOrNew();

                $lesson->name = $subject['name'];
                $lesson->asc_xml_id = $subject['id'];

                $lesson->save();
            }
        }

        //Учителя
        if (\Arr::exists($request, 'teachers'))
        {
            unset($array['teachers']['@attributes']);

            if (empty($array['teachers'])) {
                throw new Exception('Teachers is empty', 2);
            }

            foreach($array['teachers']['teacher'] as $teacherFromXml)
            {
                $teacherFromXml = $teacherFromXml['@attributes'];

                $nameArray = explode(' ', $teacherFromXml['name']);

                $name = $nameArray[0];

                if (strpos($nameArray[0], '.')) $name = $nameArray[1];

                $user = User::where('second_name', $name)->orWhere('first_name', $name)->orWhere('middle_name', $name)->first();

                if (!$user) {
                    $teacher = new Teacher();
                } else {
                    $teacher = Teacher::where('user_id', $user)->firstOrNew();

                    $teacher->user_id = $user->id;
                }

                $teacher->type = 'Учитель';
                $teacher->asc_teacher_name = $name;
                $teacher->asc_xml_id = $teacherFromXml['id'];

                $teacher->save();
            }
        }

        //Кабинеты
        if (\Arr::exists($request, 'rooms'))
        {
//            Room::truncate();

            unset($array['classrooms']['@attributes']);

            if (empty($array['teachers'])) {
                throw new Exception('Rooms is empty', 3);
            }

            foreach ($array['classrooms']['classroom'] as $class) {
                $classroom = $class['@attributes'];

                $room = Room::where('name', $classroom['name'])->firstOrNew();

                $room->name = $classroom['name'];
                $room->asc_xml_id = $classroom['id'];

                $room->save();
            }
        }

        //Классы
        if (\Arr::exists($request, 'classes'))
        {
//            Classes::truncate();

            unset($array['classes']['@attributes']);

            if (empty($array['teachers'])) {
                throw new Exception('Classes is empty', 4);
            }

            foreach ($array['classes']['class'] as $cl) {
                $class = $cl['@attributes'];
                $class = str_replace(' ', '', $class);


                if (mb_strpos($class['name'], '10') !== false || mb_strpos($class['name'], '11') !== false)
                {
                    $number = mb_str_split($class['name'], 2)[0];
                    $letter = mb_str_split($class['name'], 2)[1];

                    if (mb_strlen($class['name']) == 5)
                    {
                        $letter = mb_strcut($class['name'], -5, 6);
                    }
                }
                else
                {
                    $number = mb_strcut($class['name'], 0, 1);

                    if (mb_strlen($class['name']) == 3)
                    {
                        $letter = mb_strcut($class['name'], -4, 4);
                    }
                    elseif (mb_strlen($class['name']) == 4)
                    {
                        $number = mb_str_split($class['name'], 1)[0];
                        $letter = mb_strcut($class['name'], -5, 6);
                    }
                    else
                    {
                        $letter = mb_strcut($class['name'], -1, 2);
                    }
                }

                $cl = Classes::where('number', $number)->where('letter', $letter)->firstOrNew();

                $cl->number = $number;
                $cl->letter = $letter;
                $cl->alias = Translit::translitInEn($number . mb_strtolower($letter));
                $cl->shift = 0;

                $cl->asc_xml_id = $class['id'];

                $cl->save();
            }
        }

        //Группы
        if (\Arr::exists($request, 'groups'))
        {
//            Group::truncate();

            unset($array['groups']['@attributes']);

            if (empty($array['groups'])) {
                throw new Exception('Groups is empty', 6);
            }

            foreach ($array['groups']['group'] as $group) {
                $group= $group['@attributes'];


                $class = Classes::where('asc_xml_id', $group['classid'])->get();

                $gr = Group::where('name', $group['name'])->where('class_id', $class->first()->id)->firstOrNew();

                $gr->name = $group['name'] ?? 'Ошибка';
                $gr->class_id = $class->first()->id;
                $gr->asc_xml_id = $group['id'];

                $gr->save();

            }
        }

        //Нагрузка
        if (\Arr::exists($request, 'load'))
        {
//            Load::truncate();

            unset($array['lessons']['@attributes']);

            if (empty($array['lessons'])) {
                throw new Exception('Lessons is empty', 7);
            }

            $allLessons = Lesson::all();
            $allClasses = Classes::all();
            $allTeachers = Teacher::all();
            $allGroups = Group::all();

            foreach ($array['lessons']['lesson'] as $ls) {
                $ls = $ls['@attributes'];

                $lesson = $allLessons->where('asc_xml_id', $ls['subjectid'])->first();
                $class =  $allClasses->where('asc_xml_id', $ls['classids'])->first();
                $teacher = $allTeachers->where('asc_xml_id', $ls['teacherids'])->first();
                $group = $allGroups->where('asc_xml_id', $ls['groupids'])->first();

                $load = new Load();

                $load->lesson_id = $lesson->id;
                $load->class_id = $class->id;
                $load->teacher_id = $teacher->id;
                $load->group_id = $group->id;
                $load->asc_xml_id = $ls['id'] ?? 'Ошибка';

                $load->save();
            }
        }

        //Расписание
        if (\Arr::exists($request, 'timetable'))
        {
            unset($array['cards']['@attributes']);

            if (empty($array['cards'])) {
                throw new Exception('Cards is empty', 8);
            }

            $cards = $array['cards']['card'];

            $allTimetable = Timetable::all();
            $allLessons = Lesson::all();
            $allClasses = Classes::all();
            $allGroups = Group::all();
            $allLoad = Load::all();
            $allTeachers = Teacher::all();
            $allRooms = Room::all();

            $dontDelete = [];
            $classesWhereChanged = [];

            if ($allTimetable->isEmpty())
            {
                foreach($cards as $card) {
                    $card = $card['@attributes'];

                    $load = $allLoad->where('asc_xml_id', $card['lessonid'])->first();
                    $room = $allRooms->where('asc_xml_id', $card['classroomids'])->first();

                    $day = $this->convertDays($card['days']);

                    $tt = new Timetable();

                    $tt->lesson_id = $load->lesson_id;
                    $tt->teacher_id = $load->teacher_id;
                    $tt->class_id = $load->class_id;
                    $tt->group_id = $load->group_id;
                    $tt->load_id = $load->id;
                    $tt->number = $card['period'];
                    $tt->weekday = $day;
                    $tt->rooms = ['room1' => ['room' => $room->name, 'room_id' => $room->id]];

                    $tt->save();

                    $dontDelete[] = $tt->id;
                    $classesWhereChanged[] = $tt->class_id;
                }
            }
            else
            {
                foreach ($cards as $card) {
                    $card = $card['@attributes'];

                    $load = $allLoad->where('asc_xml_id', $card['lessonid'])->first();
                    $class = $allClasses->find($load->class_id);
                    $group = $allGroups->find($load->group_id);

                    $day = $this->convertDays($card['days']);
                    $number = (int)$card['period'];

                    $tt = $allTimetable->where('class_id', $class->id)->where('group_id', $group->id)->where('number', $number)->where('weekday', $day)->first();

                    if ($tt == null)
                    {
                        $room = $allRooms->where('asc_xml_id', $card['classroomids'])->first();

                        $tt = new Timetable();

                        $tt->lesson_id = $load->lesson_id;
                        $tt->teacher_id = $load->teacher_id;
                        $tt->class_id = $load->class_id;
                        $tt->group_id = $load->group_id;
                        $tt->load_id = $load->id;
                        $tt->number = $card['period'];
                        $tt->weekday = $day;
                        $tt->rooms = ['room1' => ['room' => $room->name, 'room_id' => $room->id]];

                        $tt->save();
                    }
                    else
                    {
                        $room = $allRooms->find($tt->rooms['room1']['room_id']);

                        if ($tt->load_id == $load->id && $room->asc_xml_id == $card['classroomids'])
                        {
                            $classesWhereChanged[] = $tt->class_id;
                            $dontDelete[] = $tt->id;
                            continue;
                        }
                        else
                        {
                            $tt->lesson_id = $load->lesson_id;
                            $tt->teacher_id = $load->teacher_id;
                            $tt->class_id = $load->class_id;
                            $tt->group_id = $load->group_id;
                            $tt->load_id = $load->id;
                            $tt->rooms = ['room1' => ['room' => $room->name, 'room_id' => $room->id]];

                            $tt->save();

                            $classesWhereChanged[] = $tt->class_id;
                            $dontDelete[] = $tt->id;
                        }
                    }
                }


                foreach ($allTimetable as $tt) {
                    if (!in_array($tt->id, $dontDelete)) {
                        if (in_array($tt->class_id, $classesWhereChanged)) $tt->delete();
                    }
                }
            }
        }

        return true;
    }

    private function convertDays($days): int
    {
        return match ($days) {
            '100000' => 0,
            '010000' => 1,
            '001000' => 2,
            '000100' => 3,
            '000010' => 4,
            '000001' => 5,
        };
    }
}
