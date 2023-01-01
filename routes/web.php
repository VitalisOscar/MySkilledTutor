<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\NotificationsController;
use App\Http\Controllers\Client\Orders\CreateOrderController;
use App\Http\Controllers\Client\Orders\OrdersController;
use App\Http\Controllers\Client\Orders\SingleOrderController;
use App\Http\Controllers\Client\PaymentController;
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

    Route::get('verification', [UserAccountController::class, 'verifyEmail'])->name('verify_email');
    Route::post('verification', [UserAccountController::class, 'verifyEmail'])->name('verify_email');

    Route::post('verification/get-code', [UserAccountController::class, 'resendVerificationCode'])->name('get_verification_code');
});

// Client area
Route::prefix('client')
->middleware(['auth', 'verified_email'])
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

        Route::get('history/{status}', OrdersController::class)->name('.all');

        // Order creation
        // Step 1
        Route::get('create/{order?}', [CreateOrderController::class, 'start'])->name('.create');
        Route::post('create/{order?}', [CreateOrderController::class, 'start'])->name('.create');

        // Step 2
        Route::get('create/{order}/requirements', [CreateOrderController::class, 'requirements'])->name('.create.requirements');
        Route::post('create/{order}/requirements', [CreateOrderController::class, 'requirements'])->name('.create.requirements');

        // Step 3
        Route::get('create/{order}/review', [CreateOrderController::class, 'review'])->name('.create.review');
        Route::post('create/{order}/review', [CreateOrderController::class, 'review'])->name('.create.review');

        Route::get('{order}', SingleOrderController::class)->name('.single');
        Route::post('{order}/send-message', [SingleOrderController::class, 'sendMessage'])->name('.send_message');


        // Order Payments
        Route::prefix('payments')
        ->name('.payments')
        ->group(function(){
            Route::get('for/{order}/attempt', [PaymentController::class, 'process'])->name('.attempt');
            Route::get('for/{order}/completed', [PaymentController::class, 'completed'])->name('.completed');
            Route::get('for/{order}/cancelled', [PaymentController::class, 'cancelled'])->name('.cancelled');
        });

    });
});

// Admin
require __DIR__.'/admin.php';
