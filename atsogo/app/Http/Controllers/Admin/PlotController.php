<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlotRequest;
use App\Http\Requests\UpdatePlotRequest;
use Illuminate\Http\Request;

class PlotController extends Controller
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
     * Store a newly created resource in storage.
     */
    
    /**
     * Display the specified resource.
     */
    public function show(Plot $plot)
    {
        if ($plot->status !== 'available') {
                    abort(404);
                }

                    return view('customer.plots.show', compact('plot'));
        }
    
    }

    