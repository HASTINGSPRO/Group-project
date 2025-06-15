<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlotRequest;
use App\Http\Requests\UpdatePlotRequest;

class AdminPlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Plots = Plot::latest()->paginate(10);
        $activeView = 'admin_plots_index';
        
        return view('admin.plots.index', compact('Plots', 'activeView'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activeView = 'admin_plots_create';
        
        return view('admin.plots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlotRequest $request)
    {
        $validated = $request->validated([
             'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'area_sqm' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'status' => 'required|in:available,sold,reserved',
            'is_new_listing' => 'boolean',
        ]);
        Plot::create($validated);

        return redirect()->route('admin.plots.index')
            ->with('success', 'Plot created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plot $plot)
    {
        $activeView = 'admin_plots_show';
        
        return view('admin.plots.show', compact('plot', 'activeView'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plot $plot)
    {
        $activeView = 'admin_plots_edit';
        
        return view('admin.plots.edit', compact('plot', 'activeView'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlotRequest $request, Plot $plot)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'area_sqm' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'status' => 'required|in:available,sold,reserved',
            'is_new_listing' => 'boolean',
        ]);

        $plot->update($validated);
        
        return redirect()->route('admin.plots.index')
            ->with('success', 'Plot updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plot $plot)
    {
        $plot->delete();

        return redirect()->route('admin.plots.index')
            ->with('success', 'Plot deleted successfully.');
    }
}