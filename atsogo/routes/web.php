<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PlotController as AdminPlotController;
use App\Http\Controllers\Customer\PlotController as CustomerPlotController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

        Route::post('/logout', [AuthController::class,'logoutUser'])->name('logout');

         Route::view('/dashboard', view: 'customer.dashboard')->name('dashboard');

        // Customer routes
        Route::get('/plots', [CustomerPlotController::class, 'index'])->name('plots.index');
        Route::get('/plots/create', [CustomerPlotController::class, 'create'])->name('plots.create');
        Route::get('/plots/{Plot}', [CustomerPlotController::class, 'show'])->name('plots.show');
        Route::resource('plots', CustomerPlotController::class)->only(['show', 'index']);
 
        // Admin routes
        Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::resource('plots', AdminPlotController::class)->except(['show']);
        Route::get('plots/{plot}', [AdminPlotController::class, 'show'])->name('plots.show');
    });

}); // <-- closes the Route::middleware(['auth'])->group

Route::middleware(['guest'])->group(function () {
    Route::view('/', 'auth.login')->name('home');

    Route::view('/register', 'auth.register')->name('register');

    Route::post('/register', [AuthController::class,'registerUser']);

    Route::view('/login', 'auth.login')->name('login');
    
    Route::post('/login', [AuthController::class,'loginUser']);
});
        


