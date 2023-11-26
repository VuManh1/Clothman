<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Mail\OrderShipped as MailOrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderShippedNotification implements ShouldQueue
{
    public string $connection = 'database';
    
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
     * @param  \App\Events\OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        Mail::to($event->order->email)->queue(new MailOrderShipped($event->order));
    }
}
