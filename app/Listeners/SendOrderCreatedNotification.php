<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        $user = User::first();
        try {
            $user->notify(new OrderCreatedNotification($order));
        }catch (\Throwable $e)
        {
            throw $e;
        }



//        $users = User::where('store_id',$order->store_id)->get();
//        Notification::sendNow($users,new OrderCreatedNotification($order));
    }
}
