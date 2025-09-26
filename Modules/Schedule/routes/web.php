<?php

use Illuminate\Support\Facades\Route;
use Modules\Schedule\Http\Controllers\ScheduleController;

Route::prefix('schedule')->name('schedule.')->group(function () {
    Route::get('/booking', [ScheduleController::class, 'booking'])->name('booking');
});

