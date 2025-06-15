<?php

use App\Http\Admin\Controllers\AdminPlotController as ControllersAdminPlotController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminPlotController; // ← Fixed import path
use App\Http\Controllers\Customer\PlotController as CustomerPlotController;

use App\Models\Plot;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Default welcome route - redirects to the main dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Routes that require authentication for both customers and admins
Route::middleware(['auth'])->group(function () {
    Route::resource('/plotes', AdminPlotController::class);

    Route::view('/', 'auth.login')->name('home');
    // Logout route
    Route::post('/logout', [AuthController::class, 'logoutUser'])->name('logout');
    Route::view("dashboard")->name("dashboard");
});

// Guest routes
Route::middleware(['guest'])->group(function () {
    
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'registerUser']);
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'loginUser']);
});