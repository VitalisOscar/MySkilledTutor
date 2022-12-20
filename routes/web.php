<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\NotificationsController;
use App\Http\Controllers\Client\OrdersController;
use App\Http\Controllers\Client\SingleOrderController;
use App\Http\Controllers\Client\UserAccountController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Front routes
Route::get('/', [FrontController::class, 'landing'])->name('landing');


// Client routes

// Authentication
Route::prefix('auth')
->group(function(){
    Auth::routes();
});

// Client area
Route::prefix('client')
->middleware('auth')
->name('client')
->group(function(){

    Route::get('dashboard', DashboardController::class)->name('.dashboard');

    Route::get('notifications', NotificationsController::class)->name('.notifications');

    // Account management
    Route::get('account', UserAccountController::class)->name('.account');
    Route::post('account/password', [UserAccountController::class, 'updatePassword'])->name('.account.password');

    // Orders
    Route::prefix('orders')
    ->name('.orders')
    ->group(function(){

        Route::get('all', OrdersController::class)->name('.all');

        Route::get('create', [OrdersController::class, 'create'])->name('.create');
        Route::post('create', [OrdersController::class, 'create'])->name('.create');

        Route::get('{order}', SingleOrderController::class)->name('.single');

    });
});