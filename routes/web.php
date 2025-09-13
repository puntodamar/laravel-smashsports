<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Modules\Schedule\Http\Controllers\ScheduleController;




Route::middleware('guest')->group(function () {
    Route::prefix('schedule')->name('schedule.')->group(function () {
        Route::get('/booking', [ScheduleController::class, 'booking'])->name('booking');
    });
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/login', fn () => Inertia::render('Auth/Login', []))->name('login');
    // Route::get('/register', fn () => Inertia::render('Auth/Register'))->name('register'); // if you enable registration
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
