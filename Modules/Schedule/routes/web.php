<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Schedule\Http\Controllers\ScheduleController;

Route::prefix('schedule')
    ->name('schedule.')
    ->middleware(['web', 'schedule.inertia'])
    ->group(function () {
        Route::resource('schedule', ScheduleController::class);
    });


