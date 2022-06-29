<?php

namespace App\Http\Controllers\RingSchedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRingScheduleTypesRequest;
use App\Http\Requests\UpdateRingScheduleTypesRequest;
use App\Models\RingSchedule\RingSchedule;
use App\Models\RingSchedule\RingScheduleTypes;

class RingScheduleTypesController extends Controller
{
    public function all()
    {
        return RingScheduleTypes::with( ['RingSchedule', 'RingScheduleEvents'])->get();
    }

    public function store(StoreRingScheduleTypesRequest $request)
    {
        $type = new RingScheduleTypes();

        $type->name = $request->name;
        $type->shift = $request->shift;
        $type->type = $request->type;

        $type->save();

        $allRingSchedule = $type->RingSchedule()->get();

        foreach ($request->ringSchedule as $number => $rs) {
            if ($rs['start_time'] && $rs['end_time']) {
                $ringSchedule = new RingSchedule();


                $ringSchedule->start_time = $rs['start_time'];
                $ringSchedule->end_time = $rs['end_time'];
                $ringSchedule->number = $number;
                $ringSchedule->ring_schedule_type_id = $type->id;

                $ringSchedule->save();
            } else {
                continue;
            }
        }

        return response('Succesful create', 200);
    }

    public function update(UpdateRingScheduleTypesRequest $request)
    {
        $type = RingScheduleTypes::find($request->id);

        $type->name = $request->name;
        $type->shift = $request->shift;
        $type->type = $request->type;

        $type->save();

        $allRingSchedule = $type->RingSchedule()->get();

        foreach ($request->ringSchedule as $number => $rs) {
            $ringSchedule = $allRingSchedule->where('number', $number)->first();

            if ($rs['start_time'] && $rs['end_time']) {
                if ($ringSchedule == null) {
                    $ringSchedule = new RingSchedule();
                }

                $ringSchedule->start_time = $rs['start_time'];
                $ringSchedule->end_time = $rs['end_time'];
                $ringSchedule->number = $number;
                $ringSchedule->ring_schedule_type_id = $type->id;

                $ringSchedule->save();
            } else {
                continue;
            }
        }

        return response('Succesful edit', 200);
    }

    public function destroy($id)
    {
        $type = RingScheduleTypes::find($id);
        $allRingSchedule = $type->RingSchedule()->delete();
        $type->delete();
    }
}
