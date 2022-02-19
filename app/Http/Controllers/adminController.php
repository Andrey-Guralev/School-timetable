<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function indexUsers()
    {
        $users = User::all();
        $classes = Classes::all();

        return view('admin.adminUsers', compact('users', 'classes'));
    }

    public function changeUserType($user, $type): \Illuminate\Http\RedirectResponse
    {
        $user = User::find($user);

        $user->type = $type;
        $user->save();

        return redirect()->back();
    }

    public function changeTeacherClass(Request $request)
    {
        $user = User::find($request->id);

        $user->class_id = $request->class;

        $user->save();

        return response('success', 200);
    }
}
