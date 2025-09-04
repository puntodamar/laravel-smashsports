<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Schedule\Http\Controllers\ScheduleController;


Route::prefix('schedule')->name('schedule.')->group(function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
