<?php

namespace App\Http\Controllers\RingSchedule;

use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRingScheduleEventsRequest;
use App\Http\Requests\UpdateRingScheduleEventsRequest;
use App\Models\RingSchedule\RingScheduleEvents;
use Carbon\Carbon;

class RingScheduleEventsController extends Controller
{
    public function all($date = null)
    {
        if ($date) {
            $date = new Carbon($date);

            $events = RingScheduleEvents::where('date', $date)->with('RingScheduleType', 'RingScheduleType.RingSchedule')->get();
        } else {
            $events = RingScheduleEvents::with('RingScheduleType', 'RingScheduleType.RingSchedule')->get();
        }

        return $events;
    }

    public function store(StoreRingScheduleEventsRequest $request)
    {
        $event = new RingScheduleEvents();

        $event->name = $request->name;
        $event->ring_schedule_type_id = $request->type;
        $event->date = $request->date;

        $event->save();

        return response('Successful', 200);
    }

    public function update(UpdateRingScheduleEventsRequest $request)
    {
        $event = RingScheduleEvents::find($request->id);

        $event->name = $request->name;
        $event->ring_schedule_type_id = $request->type;

        $event->save();

        return response('Successful', 200);
    }

    public function destroy($id)
    {
        RingScheduleEvents::find($id)->delete();
    }
}
