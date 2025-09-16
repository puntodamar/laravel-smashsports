<?php

use Illuminate\Support\Facades\Route;
use Modules\Store\Http\Controllers\StoreController;

Route::middleware('guest')->group(function () {
    Route::prefix('toko')->name('store.')->group(function () {
        Route::get('/', [StoreController::class, 'index'])->name('index');
    });
});
