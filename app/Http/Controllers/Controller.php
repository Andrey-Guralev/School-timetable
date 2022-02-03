<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Ramsey\Uuid\Type\Time;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        if (session('class')) {
            $timetable = Timetable::where('class_id', session('class'))->get();
            return view('index', compact('timetable'));
        }

        return view('index');
    }

}
