<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\RingSchedule;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function event;
use function redirect;
use function response;
use function view;

class AdminController extends Controller
{
    public function indexUsers()
    {
        $users = User::all();
        $classes = Classes::all();

        return view('admin.users.adminUsers', compact('users', 'classes'));
    }

    public function changeUserType($user, $type): \Illuminate\Http\RedirectResponse
    {
        $user = User::find($user);

        $user->type = $type;
        $user->save();

        return redirect()->back();
    }

    public function changeTeacherClass(Request $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $user = User::find($request->id);

        if ($request->class == 'null') {
            $user->class_id = null;
        } else {
            $user->class_id = $request->class;
        }

        $user->save();

        return response('success', 200);
    }

    public function registerUserPage()
    {
        $classes = Classes::all();

        return view('admin.users.userRegister', compact('classes'));
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::default()],
            'first_name' => ['string', 'max:255'],
            'second_name' => ['string', 'max:255'],
            'middle_name' => ['max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'middle_name' => $request->middle_name,
            'email' => $request->email,
            'class_id' => $request->class == 'null' ? null : $request->class,
            'type' => 2,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('adminUsers');
    }
}
