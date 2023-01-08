<?php

namespace App\Listeners;

use App\Events\OrderCancelledEvent;
use App\Notifications\OrderCancelledNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCancelledListener
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
    public function handle(OrderCancelledEvent $event)
    {
        $event->order->user->notify(new OrderCancelledNotification($event->order));
    }
}
