<?php

namespace App\Services\Cart\Interfaces;

use App\DTOs\Cart\AddToCartDto;
use App\DTOs\Cart\RemoveCartDto;
use App\DTOs\Cart\UpdateCartDto;

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

    /**
     * Update a cart
     * 
     * @return array (items, total)
     */
    public function updateCart(UpdateCartDto $data): array;

    /**
     * Remove a cart
     * 
     * @return array (items, total)
     */
    public function removeCart(RemoveCartDto $data): array;
}
