<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware(['isGuest'])->group( function() {
    Route::controller(DashboardController::class)->group(function() {
        // user route
        route::get('/dashboard/user', 'indexUser')->name('dashboard.user');
        route::get('/dashboard/user/register', 'Register')->name('dashboard.user.register');
        route::post('/dashboard/user/create', 'createUser')->name('dashboard.user.create');
    });
});