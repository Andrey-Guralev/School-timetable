<?php

namespace App\Http\Controllers;

use App\Models\TelegramSubscribers;
use App\Http\Requests\StoreTelegramSubscribersRequest;
use App\Http\Requests\UpdateTelegramSubscribersRequest;

class TelegramSubscribersController extends Controller
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
     * @param  \App\Http\Requests\StoreTelegramSubscribersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTelegramSubscribersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TelegramSubscribers  $telegramSubscribers
     * @return \Illuminate\Http\Response
     */
    public function show(TelegramSubscribers $telegramSubscribers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TelegramSubscribers  $telegramSubscribers
     * @return \Illuminate\Http\Response
     */
    public function edit(TelegramSubscribers $telegramSubscribers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTelegramSubscribersRequest  $request
     * @param  \App\Models\TelegramSubscribers  $telegramSubscribers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTelegramSubscribersRequest $request, TelegramSubscribers $telegramSubscribers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TelegramSubscribers  $telegramSubscribers
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelegramSubscribers $telegramSubscribers)
    {
        //
    }
}
