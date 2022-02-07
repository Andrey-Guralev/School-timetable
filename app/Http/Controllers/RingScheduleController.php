<?php

namespace App\Http\Controllers;

use App\Models\ringSchedule;
use App\Http\Requests\StoreringScheduleRequest;
use App\Http\Requests\UpdateringScheduleRequest;

class RingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreringScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreringScheduleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ringSchedule  $ringSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(ringSchedule $ringSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ringSchedule  $ringSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(ringSchedule $ringSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateringScheduleRequest  $request
     * @param  \App\Models\ringSchedule  $ringSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateringScheduleRequest $request, ringSchedule $ringSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ringSchedule  $ringSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ringSchedule $ringSchedule)
    {
        //
    }
}
