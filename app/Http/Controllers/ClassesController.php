<?php

namespace App\Http\Controllers;

use App\Contracts\Translit\Translit;
use App\Http\Requests\classLoginRequest;
use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Models\Timetable;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class ClassesController extends Controller
{
    public function __construct()
    {
        $this->translit = app(Translit::class);
    }

    public function get(): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $classes = Classes::all();

        $classes = json_encode($classes);

        return response($classes,200);
    }

    public function getById($id): Classes|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|array|null
    {
        return Classes::find($id);
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.classes.editClasses');
    }

    public function store(StoreClassesRequest $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $class = new Classes();

        $class->number = $request->number;
        $class->letter = $request->letter;
        $class->alias = $this->translit->translitInEn($request->number . mb_strtolower($request->letter));
        $class->shift = $request->shift;

        $class->save();

        return response(['rId' => $class->id, 'pass' => $class->password], '201');
    }

    public function update(UpdateClassesRequest $request, classes $classes): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $class = Classes::find($request->id);

        $class->number = $request->number;
        $class->letter = $request->letter;
        $class->alias = $this->translit->translitInEn($request->number . mb_strtolower($request->letter));
        $class->shift = $request->shift;

        $class->save();

        return response('Ok', '200');
    }


    public function destroy($id): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $class = Classes::find($id);

//        Timetable::where('class_id', $id)->delete();

        $class->delete();

        return response('', 200);
    }
}
