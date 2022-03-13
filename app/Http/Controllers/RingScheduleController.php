<?php

namespace App\Http\Controllers;

use App\Actions\RingScheduleHandler;
use App\Models\ringSchedule;
use App\Http\Requests\UpdateringScheduleRequest;

class RingScheduleController extends Controller
{

    public function edit()
    {
        $rings = RingSchedule::all();

        return view('admin.ringSchedule.ringScheduleEdit', compact('rings'));
    }

    public function update(UpdateringScheduleRequest $request)
    {
        $data = $request->all();

        $handler = new RingScheduleHandler();
        $handler->handle($data);

        return redirect()->back();
    }
}
