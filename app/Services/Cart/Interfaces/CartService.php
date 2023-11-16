<?php

namespace App\Services\Cart\Interfaces;

use App\DTOs\Cart\AddToCartDto;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CartService
{
    /**
     * Get all carts
     */
    public function getCarts(): Collection;

    /**
     * Add a cart
     */
    public function addToCart(AddToCartDto $data): bool;
}
