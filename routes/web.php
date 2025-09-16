<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Modules\Schedule\Http\Controllers\ScheduleController;
use Modules\Store\Http\Controllers\StoreController;


Route::middleware('guest')->group(function () {
    Route::prefix('schedule')->name('schedule.')->group(function () {
        Route::get('/booking', [ScheduleController::class, 'booking'])->name('booking');
    });

    Route::prefix('toko')->name('store.')->group(function () {
        Route::get('/', [StoreController::class, 'index'])->name('index');
    });

    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/login', fn () => Inertia::render('Axuth/Login', ['mode' => 'login']))->name('login');
    Route::get('/register', fn () => Inertia::render('Auth/Register', ['mode' => 'register']))->name('register');
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
