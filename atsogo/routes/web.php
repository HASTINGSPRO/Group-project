<?php
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
        Route::view('/dashboard', 'customer.dashboard')->name('dashboard');

        Route::post('/logout', [AuthController::class,'logoutUser'])->name('logout');

});

Route::middleware(['guest'])->group(function () {
      Route::view('/', 'welcome')->name('home');

        Route::view('/register', 'auth.register')->name('register');

        Route::post('/register', [AuthController::class,'registerUser']);

        Route::view('/login', 'auth.login')->name('login');
        
        Route::post('/login', [AuthController::class,'loginUser']);
});
        

        


