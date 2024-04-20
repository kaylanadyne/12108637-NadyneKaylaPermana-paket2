<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['isLogin'])->group( function() {
    Route::controller(AuthController::class)->group( function() {
        Route::get('/', 'index');
        Route::post('/auth', 'auth')->name('auth');
    });
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');