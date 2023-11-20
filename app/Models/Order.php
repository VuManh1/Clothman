<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'payment_id',
        'code',
        'status',
        'customer_name',
        'email',
        'address',
        'phone_number',
        'total',
        'cancel_reason',
        'note',
    ];

    /**
     * Get formated date string of the created_at field
     */
    public function getFormatedCreatedAt() {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    /**
     * Get formated string of the total field
     */
    public function getFormatedTotal() {
        return number_format($this->total, 0, '.', '.');
    }

    /**
     * Get the payment of the order.
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items of the order.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
