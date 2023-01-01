<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Message;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Relation::morphMap([
            Order::MODEL_NAME => Order::class,
            Message::MODEL_NAME => Message::class,
            Admin::MODEL_NAME => Admin::class,
            User::MODEL_NAME => User::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
