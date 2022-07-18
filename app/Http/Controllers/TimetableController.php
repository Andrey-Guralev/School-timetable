<?php

namespace App\Http\Controllers;

use App\Contracts\TimetableParser\TimetableXmlParser;
use App\Http\Requests\StoreXmlTimetableRequest;
use App\Jobs\TelegramTimetableUpdateNotification;
use App\Models\Classes;
use App\Models\Timetable;
use App\Providers\RouteServiceProvider;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Storage;

class TimetableController extends Controller
{
    public function getById($id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|array|Timetable|null
    {
        return Timetable::find($id);
    }

    public function getByCLass($class): \Illuminate\Database\Eloquent\Collection|array
    {
        return Timetable::with('Class', 'Lesson', 'Group', 'Teacher', 'Teacher.User')->where('class_id', $class)->get();
    }

    public function getByTeacher($teacher_id): \Illuminate\Database\Eloquent\Collection|array
    {
        return Timetable::with('Class', 'Lesson', 'Group', 'Teacher', 'Teacher.User')->where('teacher_id', $teacher_id)->get();
    }

    public function get(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Timetable::with('Class', 'Lesson', 'Group', 'Teacher.User')->get();
    }

    public function getPageForClass($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $classes = Classes::all();
        $class = $classes->find($id);


        if (\Auth::user()->type == 2) {
            return view('teacher.timetableForClass', compact('class', 'classes'));
        } elseif (\Auth::user()->type == 4) {
            return view('admin.timetableForClass', compact('class', 'classes'));
        } else {
            return redirect(RouteServiceProvider::HOME);
        }
    }

    public function edit(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $classes = Classes::all()->sortByDesc('number');

        return view('admin.timetable.timetableIndex', compact('classes'));
    }

    public function storeXml(StoreXmlTimetableRequest $request, TimetableXmlParser $parser)
    {
        try {
            $parser->parseXml($request->file('xml'), json_decode($request->parametrs, true));
        } catch (\Throwable $throwable) {
            switch ($throwable->getMessage()) {
                case 'Xml laod error':
                    return response('Ошибка загрузки файла', 200);

                case 'Incorrect xml structure':
                    return response('Неправильная структура файла', 200);

                default:
                    return response('Неизвестная ошибка',200);
            }
        }

        return response( '',200);
    }
}

