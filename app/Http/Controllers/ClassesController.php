<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use DebugBar\DebugBar;

class ClassesController extends Controller
{

    public function store(StoreClassesRequest $request)
    {
        $class = new Classes();

        $class->number = $request->number;
        $class->letter = $request->letter;

        $class->save();

        return response(['rId' => $class->id], '200');
    }

    public function edit(classes $classes)
    {
        $classes = Classes::all()->sortByDesc('number');

        return view('editClasses', compact('classes'));
    }

    public function update(UpdateClassesRequest $request, classes $classes)
    {
        $class = Classes::find($request->id);

        $class->number = $request->number;
        $class->letter = $request->letter;

        $class->save();

        return response('Ok', '200');
    }


    public function destroy($id)
    {
        $class = Classes::find($id);

        $class->delete();
    }
}
