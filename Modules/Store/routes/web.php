<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Store\Http\Controllers\StoreController;

Route::middleware('guest')->group(function () {
    Route::prefix('toko')->name('store.')->group(function () {
        Route::get('/', [StoreController::class, 'index'])->name('index');

        Route::prefix('produk')->name('product.')->group(function () {
            Route::get('/{product_type}/{product:slug}', [StoreController::class, 'show'])->name('detail')->missing(function () {
                if (app()->isProduction()) {
                    abort(404);
                }

                return Inertia::render('Module/Store/ProductDetail', [
                ]);
            });;
        });

    });
});
