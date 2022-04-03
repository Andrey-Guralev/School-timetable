<?php

namespace App\Http\Controllers;

use App\Models\Load;
use App\Http\Requests\StoreLoadRequest;
use App\Http\Requests\UpdateLoadRequest;

class LoadController extends Controller
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
     * @param  \App\Http\Requests\StoreLoadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function show(Load $load)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function edit(Load $load)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoadRequest  $request
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoadRequest $request, Load $load)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Load  $load
     * @return \Illuminate\Http\Response
     */
    public function destroy(Load $load)
    {
        //
    }
}
