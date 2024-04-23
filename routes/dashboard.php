<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware(['isGuest'])->group( function() {
    Route::controller(DashboardController::class)->group(function() {
        // user route
        route::get('/dashboard/user', 'indexUser')->name('dashboard.user');
        route::get('/dashboard/user/register', 'Register')->name('dashboard.user.register');
        route::post('/dashboard/user/create', 'createUser')->name('dashboard.user.create');
        route::post('/dashboard/user/delete/{id}', 'deleteUser')->name('dashboard.user.delete');
        route::post('/dashboard/user/update/{id}', 'updateUser')->name('dashboard.user.update');

        route::get('/dashboard/product', 'indexProduct')->name('dashboard.product');
        route::post('/dashboard/product/store', 'createProduct')->name('dashboard.product.create');
        route::post('/dashboard/product/updateStock/{id}', 'addStock')->name('dashboard.product.editstock');
        route::post('/dashboard/product/editStock/{id}', 'updateStock')->name('dashboard.product.updatestock');
        route::post('/dashboard/product/delete{id}', 'deleteProduct')->name('dashboard.product.delete');
        Route::get('/history/{id}/detail', 'showDetail')->name('history.detail');
        Route::get('/history/{id}/details', 'showDetails')->name('history.details');

        route::get('/dashboard/sales', 'viewSale')->name('dashboard.sales');
        route::get('/dashboard/sales/invoice', 'pdfInvoice')->name('dashboard.sales.invoice');
        route::post('/dashboard/sales/confirmpayment', 'confirm')->name('dashboard.sales.confirm');
        route::get('/dashboard/sales/back', 'back')->name('dashboard.sales.back');
        route::get('/dashboard/sales/history', 'viewHistory')->name('dashboard.sales.history');
        
    });
});