<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{

    public function getTeachers()
    {
        $teachers = Teacher::with('User')->get();

        $teachers = json_encode($teachers);

        return response($teachers, 200);
    }

    public function getTeacher($id)
    {
        $teachers = Teacher::with('User')->find($id);


        $teachers = json_encode($teachers);

        return response($teachers, 200);
    }

    public function index()
    {
//        $teachers = Teacher::all();

        return view('admin.teachers.teachersIndex');
    }


    public function store(StoreTeacherRequest $request)
    {
        if ($request->formType == 0) {
            $user = User::find($request->user_id);

            if (!$user->first()) return response('Пользователь не найден', 404);

            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->middle_name = $request->middle_nmae;
            $user->type = 2;

            $user->save();

            $teacher = new Teacher();

            $teacher->user_id = $request->user_id;
            $teacher->lessons = json_decode($request->lessons);
            $teacher->class_id = $request->class == "null" ? null : $request->class;
            $teacher->type = $request->type == "null" ? null : $request->type;

            $teacher->save();
        } else {
            $user = new User();

            $user->name = $request->name;
            $user->first_name = $request->first_name;
            $user->second_name = $request->second_name;
            $user->middle_name = $request->middle_nmae;
            $user->type = 2;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;

            $user->save();

            $teacher = new Teacher();

            $teacher->user_id = $user->id;
            $teacher->lessons = json_decode($request->lessons);
            $teacher->class_id = $request->class == "null" ? null : $request->class;
            $teacher->type = $request->type == "null" ? null : $request->type;

            $teacher->save();
        }

        return response('Учитель успешно создан!', 200);
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
        $teacher = Teacher::with('User')->find($id);

        if ($teacher->count() < 1) {
            return response('Данный учитель не существует');
        }

        $user = User::find($request->user_id);

        $user->name = $request->name ?? 'Ошибка';
        $user->first_name = $request->first_name;
        $user->second_name = $request->second_name;
        $user->middle_name = $request->middle_name;

        $user->save();

        $teacher->lessons = json_decode($request->lessons);
        $teacher->type = $request->type;
        $teacher->class_id = $request->class == 'null' ? null : $request->class;
        $teacher->user_id = $request->user_id;

        $teacher->save();

        return response('Учитель успешно обновлен');
    }


    public function destroy($id)
    {
        Teacher::find($id)->delete();
    }
}
