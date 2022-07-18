<?php

namespace App\Services\TimetableParser;

use App\Contracts\TimetableParser\TimetableXmlParser;
use App\Contracts\Translit\Translit;
use App\Jobs\TelegramTimetableUpdateNotification;
use App\Models\Classes;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Load;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimetableParser implements TimetableXmlParser
{
    private $translit;

    public function __construct()
    {
        $this->translit = app(Translit::class);
    }

    /**
     * @throws Exception
     */
    public function parseXml($file, $parametrs)
    {
        $path = Storage::putFile('xmls/', $file);

        try
        {
            $xml = Storage::get($path);
        }
        catch (\Throwable $throwable)
        {
            throw new Exception('Xml laod error');
        }

        try
        {
            $xml = simplexml_load_string($xml);
        }
        catch (\Throwable $throwable)
        {
            throw new Exception('Xml laod error');
        }

        $xml = json_decode(json_encode($xml), true);

        try
        {
            $this->checkXml($xml, $parametrs);
        }
        catch (Exception $exception)
        {
            throw new Exception('Incorrect xml structure');
        }

        if (array_key_exists('lessons', $parametrs))
            $this->parseLessons($xml['subjects']['subject']);

        if (array_key_exists('rooms', $parametrs))
            $this->parseRooms($xml['classrooms']['classroom']);

        if (array_key_exists('classes', $parametrs))
        {
            $this->parseClasses($xml['classes']['class']);
            $this->parseGroups($xml['groups']['group']);
        }

        if (array_key_exists('teachers', $parametrs))
            $this->parseTeachers($xml['teachers']['teacher']);

        if (array_key_exists('timetable', $parametrs))
        {
            $this->parseLoad($xml['lessons']['lesson']);
            $this->parseTimetable($xml['cards']['card']);
        }

        Storage::deleteDirectory('xmls');

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

            $existingClass = $allClasses->where('alias', $this->translit->translitInEn($className));

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
                $newClass->alias = $this->translit->translitInEn($className);
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
                $existingTeacher = $allTeacher->where('asc_teacher_second_name', $name);

                if ($existingTeacher->isEmpty())
                {
                    $newTeacher = new Teacher;

                    $this->saveTeacher($newTeacher, ['asc_xml_id' => $teacher['id'], 'user_id' => null, 'second_name' => $name]);
                }
                else
                {
                    $existingTeacher = $existingTeacher->first();

                    $this->saveTeacher($existingTeacher, ['asc_xml_id' => $teacher['id'], 'user_id' => null, 'second_name' => $name]);
                }
            }
            else
            {
                $existingUser = $existingUser->first();

                $existingTeacher = $allTeacher->where('user_id', $existingUser->id);

                if ($existingTeacher->isEmpty())
                {
                    $newTeacher = new Teacher;

                    $this->saveTeacher($newTeacher, ['asc_xml_id' => $teacher['id'], 'user_id' => $existingUser->id, 'second_name' => $name]);
                }
                else
                {
                    $existingTeacher = $existingTeacher->first();

                    $this->saveTeacher($existingTeacher, ['asc_xml_id' => $teacher['id'], 'user_id' => null, 'second_name' => $name]);
                }
            }
        }
    }

    private function saveTeacher($teacher, $data = ['asc_xml_id' => null, 'user_id' => null, 'second_name' => null])
    {
        $teacher->asc_xml_id = $data['asc_xml_id'];
        $teacher->user_id = $data['user_id'];
        $teacher->asc_teacher_second_name = $data['second_name'];
        $teacher->second_name = $data['second_name'];

        $teacher->save();

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

                $this->saveTimetable($newTT, $load, $tt, $weekday, $room);

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
                    $room = $allRooms->find($tt->rooms['room1']['room_id'] ?? -1);

                    $this->saveTimetable($existingTT, $load, $tt, $weekday, $room);

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

    private function saveTimetable($timetable, $load, $tt, $weekday, $room)
    {
        $timetable->lesson_id = $load->lesson_id;
        $timetable->teacher_id = $load->teacher_id;
        $timetable->class_id = $load->class_id;
        $timetable->group_id = $load->group_id;
        $timetable->load_id = $load->id;
        $timetable->number = $tt['period'];
        $timetable->weekday = $weekday;
        $timetable->rooms = ['room1' => ['room' => $room->name ?? 'Ошибка', 'room_id' => $room->id ?? 0]];

        $timetable->save();
    }

    /**
     * @throws Exception
     */
    private function checkXml($xml, $parametrs): void
    {
        if (!$xml['subjects']['subject'] && array_key_exists('lessons', $parametrs))
            throw new Exception('Lesson doesn\'t exist in xml');

        if (!$xml['teachers']['teacher'] && array_key_exists('teachers', $parametrs))
            throw new Exception('Teachers doesn\'t exist in xml');

        if (!$xml['classrooms']['classroom'] && array_key_exists('rooms', $parametrs))
            throw new Exception('Classrooms doesn\'t exist in xml');

        if (!$xml['classes']['class'] && array_key_exists('classes', $parametrs))
            throw new Exception('Classes doesn\'t exist in xml');

        if (!$xml['groups']['group'] && array_key_exists('classes', $parametrs))
            throw new Exception('Groups doesn\'t exist in xml');

        if (!$xml['lessons']['lesson'] && array_key_exists('load', $parametrs))
            throw new Exception('Lesson doesn\'t exist in xml');

        if (!$xml['cards']['card'] && array_key_exists('timetable', $parametrs))
            throw new Exception('Cards doesn\'t exist in xml');

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
