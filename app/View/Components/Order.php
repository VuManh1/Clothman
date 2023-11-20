<?php

namespace App\View\Components;

use App\Models\Order as OrderModel;
use Illuminate\View\Component;

class Order extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public OrderModel $order
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order');
    }
}
