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
        return view('admin.plots.index', compact('Plots'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        return view('admin.plots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlotRequest $request)
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

                    Plot::create($validated);

                    return redirect()->route('admin.plots.index')
                        ->with('success', 'Plot created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plot $Plot)
    {
           return view('admin.plots.show', compact('plot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plot $Plot)
    {
        return view('admin.plots.edit', compact('plot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlotRequest $request, Plot $Plot)
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

        $Plot->update($validated);
        return redirect()->route('admin.plots.index')
            ->with('success', 'Plot updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plot $Plot)
    {
        $Plot->delete();

        return redirect()->route('admin.plots.index')
            ->with('success', 'Plot deleted successfully.');
    }
}
