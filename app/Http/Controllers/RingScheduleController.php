<?php

namespace App\Http\Controllers;

use App\Models\ringSchedule;
use App\Http\Requests\StoreringScheduleRequest;
use App\Http\Requests\UpdateringScheduleRequest;

class RingScheduleController extends Controller
{

    public function edit(ringSchedule $ringSchedule)
    {


        return view('ringSchedule.ringScheduleEdit');
    }

    public function update(UpdateringScheduleRequest $request, ringSchedule $ringSchedule)
    {
        //
    }

}
