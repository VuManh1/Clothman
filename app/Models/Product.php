<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'category_id',
        'name',
        'slug',
        'description',
        'material',
        'price',
        'discount',
        'thumbnail_url',
        'size_guild_url',
        'quantity',
        'sold'
    ];

    /**
     * Get price after discount
     */
    public function getDiscountPrice() {
        $decrease = ceil($this->price * ($this->discount / 100));
        return $this->price - $decrease;
    }

    /**
     * Get the formated string of price
     */
    public function getFormatedPrice() {
        return number_format($this->price, 0, '.', '.');
    }

    /**
     * Get the formated string of discount price
     */
    public function getFormatedDiscountPrice() {
        return number_format($this->getDiscountPrice(), 0, '.', '.');
    }

    /**
     * Get the category of the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the product variants for the product.
     */
    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Get the images for the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
