<?php


use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Modules\Store\Http\Controllers\StoreController;


Route::get('/', [IndexController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => Inertia::render('Auth/Login', ['mode' => 'login']))->name('login');
    Route::get('/register', fn () => Inertia::render('Auth/Register', ['mode' => 'register']))->name('register');
});

Route::prefix('toko')->name('store.')->group(function () {
   Route::get('/', [StoreController::class, 'index'])->name('index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
