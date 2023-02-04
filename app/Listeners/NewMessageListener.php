<?php

namespace App\Listeners;

use App\Events\NewMessageEvent;
use App\Models\Admin;
use App\Notifications\NewMessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewMessageListener
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
    public function handle(NewMessageEvent $event)
    {
        $message = $event->message;

        // If sent by admin
        if($message->sender_type == Admin::MODEL_NAME){
            // Notify the client
            $message->order->user->notify(new NewMessageNotification($message->order));
        }
    }
}
