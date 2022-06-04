<?php

namespace App\Actions;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Jobs\TelegramTimetableUpdateNotification;
use App\Models\Classes;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Load;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\User;
use Exception;
use function React\Promise\all;


class TimetableParser
{
    /**
     * @param $class
     * @param $text
     * @return void
     */
    public function parseFile($class, $text): bool
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

        return true;
    }

    /**
     * @param $class
     * @param $data
     * @return bool
     */
    public function parseForm($class, $data): bool
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

        return true;
    }

    /**
     * @param $xml
     * @param $request
     * @return bool
     * @throws Exception
     */
    public function parseXml($xml, $request): void
    {
        try {
            $xml = simplexml_load_string($xml);
        }
        catch (\Throwable $throwable) {
            throw new Exception('Xml laod error' . $throwable->getMessage(), 0);
        }

        $json = json_encode($xml);
        $array = json_decode($json, true);

        if (array_key_exists('lessons', $request)) $this->parseLessons($array['subjects']['subject']);
        if (array_key_exists('rooms', $request)) $this->parseRooms($array['classrooms']['classroom']);
        if (array_key_exists('classes', $request)) {
            $this->parseClasses($array['classes']['class']);
            $this->parseGroups($array['groups']['group']);
        }
//        if (array_key_exists('groups', $request)) $this->parseGroups($array['groups']['group']);
        if (array_key_exists('teachers', $request)) $this->parseTeachers($array['teachers']['teacher']);
//        if (array_key_exists('load', $request)) $this->parseLoad($array['lessons']['lesson']);
        if (array_key_exists('timetable', $request)) {
            $this->parseLoad($array['lessons']['lesson']);
            $this->parseTimetable($array['cards']['card']);

        }
    }

    private function parseLessons($lessons): void
    {
        Lesson::truncate();
        $allLessons = Lesson::all();

        foreach ($lessons as $lesson) {
            $lesson = $lesson['@attributes'];

            $existingLesson = $allLessons->where('name', $lesson['name']);

            if ($existingLesson->isEmpty()) {
                $newLesson = new Lesson();

                $newLesson->name = $lesson['name'];
                $newLesson->asc_xml_id = $lesson['id'];

                $newLesson->save();
            } else {
                $existingLesson = $existingLesson->first();

                $existingLesson->asc_xml_id = $lesson['id'];

                $existingLesson->save();
            }
        }
    }

    private function parseRooms($rooms): void
    {
        Room::truncate();
        $allRooms = Room::all();

        foreach ($rooms as $room)
        {
            $room = $room['@attributes'];

            $existingRoom = $allRooms->where('name', $room['name']);

            if ($existingRoom->isEmpty())
            {
                $newRoom = new Room;

                $newRoom->name = $room['name'];
                $newRoom->asc_xml_id = $room['id'];

                $newRoom->save();
            }
            else
            {
                $existingRoom = $existingRoom->first();

                $existingRoom->asc_xml_id = $room['id'];

                $existingRoom->save();
            }

        }

    }

    private function parseClasses($classes): void
    {
        $allClasses = Classes::all();

        foreach ($classes as $class) {
            $class = $class['@attributes'];

            $className = str_replace(' ', '', $class['name']);

            $existingClass = $allClasses->where('alias', Translit::translitInEn($className));

            if (mb_strpos($className, '10') !== false || mb_strpos($className, '11') !== false)
            {
                $number = mb_str_split($className, 2)[0];
                $letter = mb_str_split($className, 2)[1];

                if (mb_strlen($className) == 5)
                {
                    $letter = mb_strcut($className, -5, 6);
                }
            }
            else
            {
                $number = mb_strcut($className, 0, 1);

                if (mb_strlen($className) == 3)
                {
                    $letter = mb_strcut($className, -4, 4);
                }
                elseif (mb_strlen($className) == 4)
                {
                    $number = mb_str_split($className, 1)[0];
                    $letter = mb_strcut($className, -5, 6);
                }
                else
                {
                    $letter = mb_strcut($className, -1, 2);
                }
            }

            if ($existingClass->isEmpty())
            {
                $newClass = new Classes();

                $newClass->number = $number;
                $newClass->letter = $letter;
                $newClass->alias = Translit::translitInEn($className);
                $newClass->shift = 0;
                $newClass->asc_xml_id = $class['id'];

                $newClass->save();
            }
            else
            {
                $existingClass = $existingClass->first();

                $existingClass->asc_xml_id = $class['id'];

                $existingClass->save();
            }
        }
    }

    private function parseGroups($groups): void
    {
        $allGroups = Group::all();
        $allClasses = Classes::all();

        foreach ($groups as $group) {
            $group = $group['@attributes'];

            $class = $allClasses->where('asc_xml_id', $group['classid'])->first();

            $existingGroup = $allGroups->where('name', $group['name'])->where('class_id', $class->id);

            if ($existingGroup->isEmpty()) {
                $newGroup = new Group();

                $newGroup->name = $group['name'];
                $newGroup->class_id = $class->id;
                $newGroup->asc_xml_id = $group['id'];

                $newGroup->save();
            } else {
                $existingGroup = $existingGroup->first();

                $existingGroup->asc_xml_id = $group['id'];

                $existingGroup->save();
            }
        }
    }

    private function parseTeachers($teachers): void
    {
        $allTeacher = Teacher::all();
        $allUsers = User::all();

        foreach ($teachers as $teacher)
        {
            $teacher = $teacher['@attributes'];

            $nameArray = explode(' ', $teacher['name']);
            if (strpos($nameArray[0], '.')) $name = $nameArray[1];
            else $name = $nameArray[0];

            $existingUser = $allUsers->where('second_name', $name);

            if ($existingUser->isEmpty())
            {
                $existingTeacher = $allTeacher->where('asc_teacher_name', $name);

                if ($existingTeacher->isEmpty())
                {
                    $newTeacher = new Teacher;

                    $newTeacher->asc_xml_id = $teacher['id'];
                    $newTeacher->asc_teacher_name = $name;

                    $newTeacher->save();
                }
                else
                {
                    $existingTeacher = $existingTeacher->first();

                    $existingTeacher->asc_xml_id = $teacher['id'];
                    $existingTeacher->asc_teacher_name = $name;

                    $existingTeacher->save();
                }
            }
            else
            {
                $existingUser = $existingUser->first();

                $existingTeacher = $allTeacher->where('user_id', $existingUser->id);

                if ($existingTeacher->isEmpty())
                {
                    $newTeacher = new Teacher;

                    $newTeacher->user_id = $existingUser->id;
                    $newTeacher->asc_xml_id = $teacher['id'];
                    $newTeacher->asc_teacher_name = $name;

                    $newTeacher->save();
                }
                else
                {
                    $existingTeacher = $existingTeacher->first();

                    $existingTeacher->asc_xml_id = $teacher['id'];
                    $existingTeacher->asc_teacher_name = $name;

                    $existingTeacher->save();
                }
            }
        }
    }

    private function parseLoad($xmlAllLoad): void
    {
        Load::truncate();

        $allLessons = Lesson::all();
        $allClasses = Classes::all();
        $allTeachers = Teacher::all();
        $allGroups = Group::all();
        $allLoad = Load::all();

        $dontDelete = [];

        foreach ($xmlAllLoad as $load) {
            $load = $load['@attributes'];

            $lesson = $allLessons->where('asc_xml_id', $load['subjectid'])->first();
            $class = $allClasses->where('asc_xml_id', $load['classids'])->first();
            $teacher = $allTeachers->where('asc_xml_id', $load['teacherids'])->first();
            $group = $allGroups->where('asc_xml_id', $load['groupids'])->first();

            $existingLoad = $allLoad
                ->where('lesson_id', $lesson->id)
                ->where('class_id', $class->id)
                ->where('group_id', $group->id)
                ->where('teacher_id', $teacher->id);

            if ($existingLoad->isEmpty())
            {
                $newLoad = new Load;

                $newLoad->lesson_id = $lesson->id;
                $newLoad->class_id = $class->id;
                $newLoad->group_id = $group->id;
                $newLoad->teacher_id = $teacher->id;
                $newLoad->asc_xml_id = $load['id'];

                $newLoad->save();

                $dontDelete[] = $newLoad->id;
            }
            else
            {
                $existingLoad = $existingLoad->first();

                $existingLoad->asc_xml_id = $load['id'];

                $existingLoad->save();

                $dontDelete[] = $existingLoad->id;

            }
        }

        $allLoad = Load::all();

        foreach ($allLoad as $load) {
            if (!in_array($load->id, $dontDelete)) {
                $load->delete();
            }
        }
    }

    private function parseTimetable($timetable): void
    {
        $allLoad = Load::all();
        $allTimetable = Timetable::all();
        $allClasses = Classes::all();
        $allGroups = Group::all();
        $allRooms = Room::all();

        $dontDelete = [];
        $classWhereNotify = [];
        $classWhereUpdated = [];

        foreach ($timetable as $tt)
        {
            $tt = $tt['@attributes'];

            $load = $allLoad->where('asc_xml_id', $tt['lessonid'])->first();

            $weekday = $this->convertDays($tt['days']);
            $class = $allClasses->find($load->class_id);
            $group = $allGroups->find($load->group_id);

            $existingTT = $allTimetable->where('class_id', $class->id)->where('group_id', $group->id)->where('number', $tt['period'])->where('weekday', $weekday);

            if ($existingTT->isEmpty())
            {
                $room = $allRooms->where('asc_xml_id', $tt['classroomids'])->first();

                $newTT = new Timetable();

                $newTT->lesson_id = $load->lesson_id;
                $newTT->teacher_id = $load->teacher_id;
                $newTT->class_id = $load->class_id;
                $newTT->group_id = $load->group_id;
                $newTT->load_id = $load->id;
                $newTT->number = $tt['period'];
                $newTT->weekday = $weekday;
                $newTT->rooms = ['room1' => ['room' => $room->name ?? 'Ошибка', 'room_id' => $room->id ?? 0]];

                $newTT->save();

                $dontDelete[] = $newTT->id;
                $classWhereUpdated[] = $class->id;
                $classWhereNotify[] = $class->id;
            }
            else
            {
                $existingTT = $existingTT->first();

                if ($existingTT->load_id == $load->id)
                {
                    $dontDelete[] = $existingTT->id;
                    $classWhereUpdated[] = $class->id;
                    continue;
                }
                else
                {
//                    dd($existingTT, $load, $tt);

                    $room = $allRooms->find($tt->rooms['room1']['room_id'] ?? -1);

                    $existingTT->lesson_id = $load->lesson_id;
                    $existingTT->teacher_id = $load->teacher_id;
                    $existingTT->class_id = $load->class_id;
                    $existingTT->group_id = $load->group_id;
                    $existingTT->load_id = $load->id;
                    $existingTT->number = $tt['period'];
                    $existingTT->weekday = $weekday;
                    $existingTT->rooms = ['room1' => ['room' => $room->name ?? 'Ошибка', 'room_id' => $room->id ?? 0]];

                    $existingTT->save();

                    $dontDelete[] = $existingTT->id;
                    $classWhereUpdated[] = $class->id;
                    $classWhereNotify[] = $class->id;
                }
            }
        }

        $allTimetable = Timetable::all();

        foreach ($allTimetable as $tt) {
            if(in_array($tt->class_id, $classWhereUpdated)) {
                if (!in_array($tt->id, $dontDelete)) {
                    $tt->delete();
                }
            }
        }

        foreach(array_unique($classWhereNotify) as $class) {
            TelegramTimetableUpdateNotification::dispatch($class);
        }

    }

    /**
     * @param $days
     * @return int
     */
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



//"id" => "71DE6A312B59E6CA"
//"classids" => "C4EFF45549650AAD"
//"subjectid" => "9E08545914BE61D6"
//"teacherids" => "4F75E00C8BD88E02"
//"classroomids" => "2BD9F2024ECE4D24"
//"groupids" => "DBFCB1E10C2486F6"
