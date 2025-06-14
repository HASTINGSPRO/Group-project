<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PlotController as AdminPlotController;
use App\Http\Controllers\Customer\PlotController as CustomerPlotController;
use App\Models\Plot; // Make sure to import your Plot model
use Illuminate\Support\Facades\Route;


// Default welcome route - redirects to the main dashboard (which can be role-aware)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Routes that require authentication for both customers and admins
Route::middleware(['auth'])->group(function () {

    // Logout route
    Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');

    // Unified Dynamic Dashboard Route
    // This route serves both customer and admin content dynamically.
    // The `viewType` and `id` (or `plot` for admin) parameters control the content.
    Route::get('/dashboard/{viewType?}/{id?}', function ($viewType = null, $id = null) {
        $data = []; // Data to pass to the dashboard view
        $activeView = 'overview'; // Default view is the dashboard overview
        $user = auth()->user(); // Get the authenticated user

        // Handle Admin-specific views if the user is an admin
        if ($user && $user->isAdmin()) { // Assuming isAdmin() method on User model
            if ($viewType === 'admin' && $id === 'plots') {
                // Admin: List all plots
                $data['Plots'] = Plot::orderBy('created_at', 'desc')->paginate(9); // All plots for admin
                $activeView = 'admin_plots_index';
            } elseif ($viewType === 'admin' && $id === 'plots/create') {
                // Admin: Show create form
                $activeView = 'admin_plots_create';
            } elseif ($viewType === 'admin' && preg_match('/^plots\/(\d+)\/edit$/', $id, $matches)) {
                // Admin: Show edit form for a specific plot
                $Plot = Plot::where('id', $matches[1])->firstOrFail();
                $data['plot'] = $Plot;
                $activeView = 'admin_plots_edit';
            } elseif ($viewType === 'admin' && preg_match('/^plots\/(\d+)$/', $id, $matches)) {
                // Admin: Show details for a specific plot
                $Plot = Plot::where('id', $matches[1])->firstOrFail();
                $data['plot'] = $Plot;
                $activeView = 'admin_plots_show';
            }
            // Add more admin views here if needed (e.g., users management)
        }
        // Handle Customer-specific views (or default if not admin)
        if ($activeView === 'overview' || ($user && !$user->isAdmin())) { // Only run customer logic if not already admin view
            if ($viewType === 'plot' && $id) {
                // Customer: Show single plot details
                $Plot = Plot::where('id', $id)->where('status', 'available')->firstOrFail();
                $data['plot'] = $Plot;
                $activeView = 'single_plot';
            } elseif ($viewType === 'plots') {
                // Customer: List all available plots with search/filter
                $query = Plot::where('status', 'available')
                                  ->orderBy('created_at', 'desc');

                if (request()->has('search') && !empty(request('search'))) {
                    $searchTerm = request('search');
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('title', 'like', '%' . $searchTerm . '%')
                          ->orWhere('description', 'like', '%' . $searchTerm . '%')
                          ->orWhere('location', 'like', '%' . $searchTerm . '%');
                    });
                }
                
                if (request()->has('new_listings')) {
                    $query->where('is_new_listing', true);
                }
                $data['Plots'] = $query->paginate(9); // Paginate the results
                $activeView = 'all_plots';
            } else {
                // Default dashboard overview
                $activeView = 'overview';
            }
        }
        
        // Pass the active view type and any fetched data to the dashboard view
        return view('dashboard', array_merge($data, ['activeView' => $activeView]));

    })->name('dashboard');

    // These routes will still exist but might be less used if primary navigation is via /dashboard
    // If you want to force all traffic through /dashboard, you could remove these
    // or add redirects.
    Route::get('/plots', [CustomerPlotController::class, 'index'])->name('plots.index');
    Route::get('/plots/{plot}', [CustomerPlotController::class, 'show'])->name('plots.show');

    // Admin-specific CRUD actions (these will now be handled by the dashboard route's logic)
    // You might still keep these if you prefer dedicated endpoints for POST/PUT/DELETE
    // but the GET requests for showing forms/lists are now handled by /dashboard.
    // For a fully unified dashboard, these POST/PUT/DELETE actions might also be
    // handled through methods within the dashboard closure, or via AJAX calls.
    // For now, these are kept for the actual create/update/delete submissions.
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        // You'll need to remove the GET routes here if they conflict with the dashboard
        // E.g., Route::resource('plots', AdminPlotController::class)->except(['show', 'index', 'create', 'edit']);
        // For simplicity, keeping existing resource routes for non-GET methods for now.
        // The dashboard's GET handlers above effectively replace the view-rendering part.
        Route::post('plots', [AdminPlotController::class, 'store'])->name('plots.store');
        Route::put('plots/{plot}', [AdminPlotController::class, 'update'])->name('plots.update');
        Route::delete('plots/{plot}', [AdminPlotController::class, 'destroy'])->name('plots.destroy');
    });
});

// Routes for guests (not authenticated)
Route::middleware(['guest'])->group(function () {
    Route::view('/', 'auth.login')->name('home');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'registerUser']);
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'loginUser']);
});
