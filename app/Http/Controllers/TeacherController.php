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
        $teacher = new Teacher();

        $this->saveTeacher($request, $teacher);


        return response('Учитель успешно создан!', 200);
    }

    public function update(UpdateTeacherRequest $request, $id): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $teacher = Teacher::find($id);

        $this->saveTeacher($request, $teacher);

        return response('Учитель успешно обновлен');
    }


    public function destroy($id)
    {
        Teacher::find($id)->delete();
    }

    private function saveTeacher($request, $teacher): void
    {
        $teacher->first_name = $request->first_name;
        $teacher->second_name = $request->second_name;
        $teacher->middle_name = $request->middle_name;
        $teacher->user_id = $request->user_id ?? null;
        $teacher->lessons = json_decode($request->lessons);
        $teacher->class_id = $request->class == "null" ? null : $request->class_id;
        $teacher->type = $request->type == "null" ? null : $request->type;

        $teacher->save();
    }
}
