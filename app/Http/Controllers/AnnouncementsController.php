<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Http\Requests\StoreannouncementsRequest;
use App\Http\Requests\UpdateannouncementsRequest;

class AnnouncementsController extends Controller
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
     * @param  \App\Http\Requests\StoreannouncementsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreannouncementsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcements
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcements
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateannouncementsRequest  $request
     * @param  \App\Models\Announcement  $announcements
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateannouncementsRequest $request, Announcement $announcements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcements)
    {
        //
    }
}
