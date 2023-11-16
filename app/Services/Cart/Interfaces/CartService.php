<?php

namespace App\Services\Cart\Interfaces;

use App\DTOs\Cart\AddToCartDto;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CartService
{
    /**
     * Get cart data
     * 
     * @return array (items, total)
     */
    public function getCartData(): array;

    /**
     * Get number of carts
     */
    public function getCartCount(): int;

    /**
     * Add a cart
     */
    public function addToCart(AddToCartDto $data): bool;
}
