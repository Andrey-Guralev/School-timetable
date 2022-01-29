<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use DebugBar\DebugBar;

class ClassesController extends Controller
{

    public function edit(classes $classes)
    {
        $classes = Classes::all();

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


    public function destroy(classes $classes)
    {
        //
    }
}
