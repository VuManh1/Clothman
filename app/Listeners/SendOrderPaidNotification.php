<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Mail\OrderPaid as MailOrderPaid;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderPaidNotification implements ShouldQueue
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
     * @param  \App\Events\OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        Mail::to($event->order->email)->queue(new MailOrderPaid($event->order));
    }
}
