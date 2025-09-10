<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Schedule\Http\Controllers\ScheduleController;


Route::prefix('schedule')->name('schedule.')->group(function () {
    Route::get('/booking', [ScheduleController::class, 'booking'])->name('booking');
});

Route::get('/', [IndexController::class, 'index'])->name('home');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
