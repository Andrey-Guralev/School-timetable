<?php

namespace App\Http\Controllers;

use App\Http\Requests\classLoginRequest;
use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Models\Timetable;
use App\Providers\RouteServiceProvider;
use DebugBar\DebugBar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class ClassesController extends Controller
{
    public function store(StoreClassesRequest $request)
    {
        $class = new Classes();

        $class->number = $request->number;
        $class->letter = $request->letter;
        $class->password = str_replace(['.', '/', "\\", ',', '\'', '"', ] ,'', substr(Hash::make($request->pasword), '10', '5'));

        $class->save();

        return response(['rId' => $class->id, 'pass' => $class->password], '200');
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

        Timetable::where('class_id', $id)->delete();

        $class->delete();



        return response('', 200);
    }

    public function loginPage()
    {
        $classes = Classes::select(['id', 'number', 'letter'])->get();

        return view('loginClasses', compact('classes'));
    }

    public function login(classLoginRequest $request)
    {
        $classI = $request->class;
        $password = $request->password;

        $class = Classes::find($classI);

        if (!$class) {
            return redirect()->back()->with('error', 'Выбранный класс не существует');
        }

        if ($class->password == $password) {
            session(["class" => $class->id]);
            return redirect(RouteServiceProvider::HOME)->with('success', 'Вы вощли в аккаунт');
        } else {
            return redirect()->back()->with('error', 'Неверный пароль');
        }
    }

    public function logout()
    {
        session()->forget('class');
        return redirect(RouteServiceProvider::HOME);
    }
}
