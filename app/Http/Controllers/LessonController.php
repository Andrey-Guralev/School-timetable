<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use Barryvdh\Debugbar\Facades\Debugbar;

class LessonController extends Controller
{
    public function getLessons()
    {
        $lessons = Lesson::all();

        $lessons = json_encode($lessons);

        return response($lessons, 200);
    }

    public function getLesson($id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson->first()) return response('Такой предмет не найден', 404);

        return response($lesson, 200);
    }

    public function index()
    {
        return view('admin.lessons.lessonsIndex');
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = new Lesson();

        $lesson->name = $request->name;

        $lesson->save();

        return response('Предмет усаешно создан');
    }

    public function update(UpdateLessonRequest $request, $id)
    {
        $lesson = Lesson::find($id);

        $lesson->name = $request->name;

        $lesson->save();

        return response('Предмет усаешно изминен', 200);
    }

    public function destroy($id)
    {
        Lesson::find($id)->delete();

        return response('Предмет успешно удален', 200);
    }
}
