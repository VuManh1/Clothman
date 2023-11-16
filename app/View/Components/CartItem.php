<?php

namespace App\View\Components;

use App\Models\Cart;
use Illuminate\View\Component;

class CartItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Cart $cart
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
        return view('components.cart-item');
    }
}
