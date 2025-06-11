<?php

namespace App\Http\Controllers;

use App\Models\land_plots;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storeland_plotsRequest;
use App\Http\Requests\Updateland_plotsRequest;

class LandPlotsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeland_plotsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(land_plots $land_plots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(land_plots $land_plots)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateland_plotsRequest $request, land_plots $land_plots)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(land_plots $land_plots)
    {
        //
    }
}
