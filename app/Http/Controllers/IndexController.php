<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Classes;
use App\Models\Feedback;
use App\Models\RingSchedule;
use App\Models\TelegramSubscribers;
use App\Models\Timetable;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        if (\Auth::guest() && !session('class')) // Вывод для не зарегистрированных пользователей
        {
            return $this->indexForGuest();
        }
        elseif (\Auth::guest() && session('class')) // Вывод для классов
        {
           return $this->indexForStudent();
        }
        elseif (\Auth::check() && \Auth::user()->type == 2) // Вывод для учителей
        {
            return $this->indexForTeacher();
        }
        elseif (\Auth::check() && \Auth::user()->type == 4) // Вывод для админа
        {
            return $this->indexForAdmin();
        }

        return view('index.indexForGuest')->with('error', 'Какая-то ошибка');
    }

    private function indexForGuest()
    {
        $classes = Classes::all();

        $count = 0;

        $count = \DB::table('sessions')->select('*')->count();

        $feedback = Feedback::with('Class')->where('status', 1)->limit(4)->get();

        return view('index.indexForGuest', compact('classes', 'count', 'feedback'));
    }

    private function indexForStudent()
    {
//        $timetable = Timetable::where('class_id', session('class'))->with('Teacher', 'Lesson', 'LoadR', 'Group')->get();
//
//        $announcements = Announcements::where('type', '1')->orWhere('class_id', session('class'))->get()->sortDesc();
//
//        $class = Classes::find(session('class'));
//
//        $ringSchedule = RingSchedule::where('shift', $class->shift)->get();
//        $types = 0;
//
//        if ($class->shift == 0) {
//            $types = [0, 1, 2];
//        } elseif ($class->shift == 1) {
//            $types = [3, 4, 5, 6];
//        }

        return view('index.indexForStudent');
    }

    private function indexForTeacher()
    {
        //            $timetable = Timetable::where('teacher_id', \Auth::user()->class_id)->with('Teacher', 'Class')->get();
        $classes = Classes::all();
        $announcements = Announcements::where('type', '1')->orWhere('class_id', \Auth::user()->class_id)->limit('5')->get()->sortDesc();

        return view('teacher.indexForTeacher', compact(  'classes', 'announcements'));
    }

    private function indexForAdmin()
    {
        $timetable = null;
        $classes = Classes::all();
        $announcements = Announcements::with('Classes')->get()->sortDesc();

        $count = 0;

        $count = \DB::table('sessions')->select('*')->count();

        $telegramSubsCount = TelegramSubscribers::count();


        return view('admin.indexForAdmin', compact(['timetable', 'announcements', 'classes', 'count', 'telegramSubsCount']));
    }
}
