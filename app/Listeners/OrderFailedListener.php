<?php

namespace App\Listeners;

use App\Events\OrderFailedEvent;
use App\Notifications\OrderFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderFailedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderFailedEvent $event)
    {
        $event->order->user->notify(new OrderFailedNotification($event->order));
    }
}
