<?php

namespace App\Listeners;

use App\Repositories\Interfaces\ProductRepository;
use App\Repositories\Interfaces\SaleRepository;
use App\Repositories\Interfaces\SoldRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseSoldAndSale implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private SaleRepository $saleRepository,
        private SoldRepository $soldRepository,
        private ProductRepository $productRepository
    )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $now = Carbon::now()->format('Y-m-d');

        // find sale today, increase amount if exists
        $sale = $this->saleRepository->findByDate($now);

        if ($sale) {
            $this->saleRepository->update($sale->id, [
                'amount' => $sale->amount + $event->order->total
            ]);
        } else {
            $this->saleRepository->create([
                'date' => $now,
                'amount' => $event->order->total
            ]);
        }

        $orderItems = $event->order->orderItems;

        // loop through order items and update/insert Sold
        foreach ($orderItems as $item) {
            $sold = $this->soldRepository->findByProductIdAndDate($item->product_id, $now);
    
            if ($sold) {
                $this->soldRepository->update($sold->id, [
                    'count' => $sold->amount + $item->quantity
                ]);
            } else {
                $this->soldRepository->create([
                    'product_id' => $item->product_id,
                    'date' => $now,
                    'count' => $item->quantity
                ]);
            }      
            
            $this->productRepository->increment($item->product_id, ['sold' => $item->quantity]);
        }
    }
}
