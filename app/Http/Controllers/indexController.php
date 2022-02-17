<?php

namespace App\Http\Controllers;

use App\Models\Announcements;
use App\Models\Timetable;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        if (\Auth::guest() && !session('class')) // Вывод для не зарегистрированных пользователей
        {
            return view('indexForGuest');
        }
        elseif (\Auth::guest() && session('class')) // Вывод для классов
        {
            $timetable = Timetable::where('class_id', session('class'))->with('Teacher')->get();
            $announcements = Announcements::where('type', '1')->orWhere('class_id', session('class'))->get()->sortDesc();

            return view('indexForClass', compact('timetable', 'announcements'));
        }
        elseif (\Auth::check() && \Auth::user()->type == 2) // Вывод для учителей
        {
            $timetable = Timetable::where('class_id', \Auth::user()->class_id)->with('Teacher')->get();
            $announcements = Announcements::where('type', '1')->orWhere('class_id', \Auth::user()->class_id)->get()->sortDesc();

            return view('indexForTeacher', compact('timetable', 'announcements'));
        }
        elseif (\Auth::check() && \Auth::user()->type == 3) // Вывод для диспетчера
        {

        }
        elseif (\Auth::check() && \Auth::user()->type == 4) // Вывод для админа
        {

        }

        return view('indexForGuest')->with('error', 'Какая-то ошибка');
    }

}
