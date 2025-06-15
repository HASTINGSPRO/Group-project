<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerPlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $query = Plot::where('status', 'available')->latest();
        
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%')
                  ->orWhere('location', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->has('new_listings')) {
            $query->where('is_new_listing', true);
        }

        $Plots = $query->paginate(9);

        return view('customer.plots.index', compact('Plots'));

    }
    /**
     * Display the specified resource.
     */
    public function show(Plot $Plot)
    {
        if ($Plot->status !== 'available') {
            abort(404, 'Land plot not found or not available.');
;
                }

                    return view('customer.plots.show', compact('Plots'));
        }
    
    }

    