<?php

namespace App\DTOs\Cart;

use App\Models\Product;
use App\Models\ProductVariant;

class SessionCartDto
{
    public string $product_id;
    public Product $product;
    public string $product_variant_id;
    public ProductVariant $productVariant;
    public int $quantity;
    public int $price;
    public string $formated_price;

    public function getPrice() {
        return $this->price;
    }

    public function getFormatedPrice() {
        return number_format($this->price, 0, '.', '.');
    }
}
