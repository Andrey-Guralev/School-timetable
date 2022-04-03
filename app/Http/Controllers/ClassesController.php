<?php

namespace App\Http\Controllers;

use App\Actions\Translit;
use App\Http\Requests\classLoginRequest;
use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Models\Timetable;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class ClassesController extends Controller
{

    public function get()
    {
        $classes = Classes::all();

        $classes = json_encode($classes);

        return response($classes,200);
    }

    public function store(StoreClassesRequest $request)
    {
        $class = new Classes();

        $class->number = $request->number;
        $class->letter = $request->letter;
        $class->alias = Translit::translitInEn($request->number . mb_strtolower($request->letter));
        $class->shift = $request->shift;

        $class->save();

        return response(['rId' => $class->id, 'pass' => $class->password], '200');
    }


    public function edit(classes $classes)
    {
        $classes = Classes::all()->sortByDesc('number');

        return view('admin.classes.editClasses', compact('classes'));
    }

    public function update(UpdateClassesRequest $request, classes $classes)
    {
        $class = Classes::find($request->id);
        $class->number = $request->number;
        $class->letter = $request->letter;
        $class->alias = Translit::translitInEn($request->number . mb_strtolower($request->letter));
        $class->shift = $request->shift;

        $class->save();

        return response('Ok', '200');
    }


    public function destroy($id)
    {
        $class = Classes::find($id);

        Timetable::where('class_id', $id)->delete();

        $class->delete();

        return response('', 200);
    }
}
