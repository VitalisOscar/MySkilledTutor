<?php

namespace App\Providers;

use App\Events\NewMessageEvent;
use App\Events\OrderCancelledEvent;
use App\Events\OrderCompletedEvent;
use App\Events\OrderCreatedEvent;
use App\Events\OrderFailedEvent;
use App\Listeners\NewMessageListener;
use App\Listeners\OrderCancelledListener;
use App\Listeners\OrderCompletedListener;
use App\Listeners\OrderCreatedListener;
use App\Listeners\OrderFailedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        OrderCreatedEvent::class => [OrderCreatedListener::class],
        OrderFailedEvent::class => [OrderFailedListener::class],
        OrderCancelledEvent::class => [OrderCancelledListener::class],
        OrderCompletedEvent::class => [OrderCompletedListener::class],
        NewMessageEvent::class => [NewMessageListener::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
