<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Teacher;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function findUsers($login)
    {
        $users = User::select(['id', 'name'])->where('name', 'LIKE', '%' . $login . '%')->get();


        if (!$users->first()) {
            return response([0 => ['name' => 'Не найдено', 'id' => -1]], 200);
        }

        return response($users, 200);
    }

    public function getUserForCreateTeacher($id)
    {
        $user = User::find($id);

        if (!$user->first()) return response([0 => ['name' => 'Ошибка', 'id' => -1]], 400);

        if (Teacher::where('user_id', $id)->get()->first()) return response(['name' => 'Учитель с таким пользователем уже существует', 'id' => -2], 200);

        return response($user);
    }

    public function edit()
    {
        $user = \Auth::user();

        return view('editProfile', compact('user'));
    }

    public function store(UserStoreRequest $request)
    {
        $user = \Auth::user();

        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->second_name = $request->second_name;
        $user->email = $request->email;

        $user->save();

        return redirect(RouteServiceProvider::HOME);

    }
}
