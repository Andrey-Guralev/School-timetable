<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Classes;
use App\Models\RingSchedule;
use App\Models\Timetable;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        if (\Auth::guest() && !session('class')) // Вывод для не зарегистрированных пользователей
        {
            return view('index.indexForGuest');
        }
        elseif (\Auth::guest() && session('class')) // Вывод для классов
        {
            $timetable = Timetable::where('class_id', session('class'))->with('Teacher')->get();

            $announcements = Announcements::where('type', '1')->orWhere('class_id', session('class'))->get()->sortDesc();

            $class = Classes::find(session('class'));

            $ringSchedule = RingSchedule::where('shift', $class->shift)->get();
            $types = 0;

            if ($class->shift == 0) {
                $types = [0, 1, 2];
            } elseif ($class->shift == 1) {
                $types = [3, 4, 5];
            }

            return view('index.indexForClass', compact('timetable', 'announcements', 'ringSchedule', 'types'));
        }
        elseif (\Auth::check() && \Auth::user()->type == 2) // Вывод для учителей
        {
//            $timetable = Timetable::where('teacher_id', \Auth::user()->class_id)->with('Teacher', 'Class')->get();
            $classes = Classes::all();
            $announcements = Announcements::where('type', '1')->orWhere('class_id', \Auth::user()->class_id)->get()->sortDesc();

            return view('index.indexForTeacher', compact( 'announcements', 'classes'));
        }
        elseif (\Auth::check() && \Auth::user()->type == 3) // Вывод для диспетчера
        {

        }
        elseif (\Auth::check() && \Auth::user()->type == 4) // Вывод для админа
        {
            $timetable = null;
            $classes = Classes::all();
            $announcements = Announcements::with('Classes')->get()->sortDesc();


            return view('index.indexForAdmin', compact(['timetable', 'announcements', 'classes']));
        }

        return view('indexForGuest')->with('error', 'Какая-то ошибка');
    }
}
