<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'product_variant_id',
        'user_id',
        'quantity',
    ];

    public function getPrice() {
        return $this->product->selling_price * $this->quantity;
    }

    public function getFormatedPrice() {
        return number_format($this->getPrice(), 0, '.', '.');
    }

    /**
     * Get the user of the cart.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product of the cart.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product variant of the cart.
     */
    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /**
     * Define the json format of the model
     */
    public function jsonSerialize(): Array
    {
        return [
            'id' => $this->id,
            'product' => $this->product,
            'product_id' => $this->product_id,
            'product_variant' => $this->productVariant,
            'product_variant_id' => $this->product_variant_id,
            'quantity' => $this->quantity,
            'price' => $this->getPrice(),
            'formated_price' => $this->getFormatedPrice(),
        ];
    } 
}
