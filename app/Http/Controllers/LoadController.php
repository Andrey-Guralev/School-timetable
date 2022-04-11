<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Http\Requests\StoreLoadRequest;
use App\Http\Requests\UpdateLoadRequest;
use Barryvdh\Debugbar\Facades\Debugbar;
use function PHPUnit\Framework\throwException;

class LoadController extends Controller
{
    public function getAllLoad()
    {
        return Load::all();
    }

    public function getLoad($id)
    {
        return Load::find($id);
    }

    public function index()
    {
        return view('admin.load.loadIndex');
    }


    public function store(StoreLoadRequest $request)
    {
        $load = new Load();

        $load->lesson_id = $request->lessonId;
        $load->class_id = $request->classId;
        $load->teacher_id = $request->teacherId;

        $load->save();

        return response('Нагрузка успешно создана', 200);

    }

    public function update(UpdateLoadRequest $request, $id)
    {
        $load = Load::find($id);

        $load->lesson_id = $request->lesson_id;
        $load->class_id = $request->class_id;
        $load->teacher_id = $request->teacher_id;

        $load->save();

        return response('Нагрузка успешно изменена', 200);
    }

    public function destroy($id)
    {
        $load = Load::find($id);

        $load->delete();

        return response('Нагрузка успешно удалена', 200);
    }
}
