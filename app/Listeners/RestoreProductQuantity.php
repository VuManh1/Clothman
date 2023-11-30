<?php

namespace App\Listeners;

use App\Events\OrderCanceled;
use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\ProductVariantRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RestoreProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private ProductRepository $productRepository,
        private ProductVariantRepository $productVariantRepository
    )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCanceled  $event
     * @return void
     */
    public function handle(OrderCanceled $event)
    {
        $orderItems = $event->order->orderItems;

        foreach ($orderItems as $item) {
            $this->productVariantRepository->increment($item->product_variant_id, [
                'quantity' => $item->quantity
            ]);

            $this->productRepository->increment($item->product_id, [
                'quantity' => $item->quantity
            ]);
        }
    }
}
