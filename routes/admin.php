<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Clients\ClientsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Orders\SingleOrderController;
use App\Http\Controllers\Admin\Orders\ViewOrdersController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->middleware('auth:admin')
->name('admin')
->group(function(){

    Route::get('', function(){ return redirect()->route('admin.dashboard'); });

    Route::get('dashboard', DashboardController::class)->name('.dashboard');

    // Auth routes
    Route::prefix('auth')
    ->name('.auth')
    ->group(function(){

        Route::get('login', [LoginController::class, 'loginForm'])->name('.login')->withoutMiddleware('auth:admin');
        Route::post('login', [LoginController::class, 'login'])->name('.login')->withoutMiddleware('auth:admin');

        Route::get('password', PasswordController::class)->name('.password');
        Route::post('password', [PasswordController::class, 'update'])->name('.password');

        Route::get('logout', function(){
            auth('admin')->logout();
            return redirect()->route('admin.auth.login');
        })->name('.logout');

    });

    // Orders routes
    Route::prefix('orders')
    ->name('.orders')
    ->group(function(){

        Route::get('all/{status}', ViewOrdersController::class)->name('.all');
        Route::get('all/from/{client}/{status}', ViewOrdersController::class)->name('.all.from_client');

        Route::get('{order}', SingleOrderController::class)->name('.single');

        Route::post('{order}/send-message', [SingleOrderController::class, 'sendMessage'])->name('.send_message');

    });

    // Clients
    Route::prefix('clients')
    ->name('.clients')
    ->group(function(){

        Route::get('all', ClientsController::class)->name('.all');

    });

});
