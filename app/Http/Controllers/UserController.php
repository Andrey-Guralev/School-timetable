<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
