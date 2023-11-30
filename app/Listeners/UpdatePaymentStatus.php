<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Repositories\Interfaces\PaymentRepository;
use App\Utils\PaymentStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePaymentStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private PaymentRepository $paymentRepository
    )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCompleted  $event
     * @return void
     */
    public function handle(OrderCompleted $event)
    {
        $this->paymentRepository->update($event->order->payment_id, [
            'status' => PaymentStatus::COMPLETED
        ]);
    }
}
