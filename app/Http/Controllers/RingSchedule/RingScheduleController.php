<?php

namespace App\Http\Controllers\RingSchedule;

use App\Actions\RingScheduleHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateringScheduleRequest;
use App\Models\RingSchedule\RingSchedule;
use App\Models\RingSchedule\RingScheduleEvents;
use App\Models\RingSchedule\RingScheduleTypes;

class RingScheduleController extends Controller
{

    public function all()
    {
        $ringScheduleTypes = RingScheduleTypes::with(['RingSchedule', 'RingScheduleEvents'])->get();
        $ringScheduleEvents = RingScheduleEvents::with(['RingScheduleType.RingSchedule'])->get();
        $ringSchedule = RingSchedule::with(['RingScheduleType'])->get();

        return [
            'ringSchedule' => $ringSchedule,
            'ringScheduleEvents' => $ringScheduleEvents,
            'ringScheduleTypes' => $ringScheduleTypes
        ];
    }

    public function edit()
    {
        return view('admin.ringSchedule.ringScheduleIndex');
    }
}
