<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function indexUsers()
    {
        $users = User::all()->sortBy(['name', 'desc']);

        return view('admin.adminUsers', compact('users'));
    }

    public function changeUserType($user, $type): \Illuminate\Http\RedirectResponse
    {
        $user = User::find($user);

        $user->type = $type;
        $user->save();

        return redirect()->back();
    }
}
