<?php

namespace App\Http\Controllers;

use App\Http\Requests\classLoginRequest;
use App\Models\Classes;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ClassesLoginController extends Controller
{
    public function loginPage()
    {
        if (session('class')) {
            session()->forget('class');
        }

        $classes = Classes::select(['id', 'number', 'letter'])->get();

        return view('auth.loginClasses', compact('classes'));
    }

    public function login(classLoginRequest $request)
    {
        $classI = $request->class;
        $password = $request->password;

        $class = Classes::find($classI);

        if (!$class) {
            return redirect()->back()->with('error', 'Выбранный класс не существует');
        }

//        if ($class->password == $password) {
        session(["class" => $class->id]);
        return redirect(RouteServiceProvider::HOME)->with('success', 'Вы вощли в аккаунт');
//        } else {
//            return redirect()->back()->with('error', 'Неверный пароль');
//        }
    }

    public function logout()
    {
        session()->forget('class');
        return redirect()->route('classesLoginPage');
    }
}
