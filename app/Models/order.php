<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'email',
        'address',
        'city',
        'province',
        'postal_code',
        'notes',
        'shipping_costs_id',
        'subtotal',
        'shipping_price',
        'total',
        'shipping_status',
        'status',
        'snap_token',
        'payment_status',
    ];

    /**
     * Relasi ke user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke shipping cost
     */
    public function shippingCost()
    {
        return $this->belongsTo(ShippingCost::class, 'shipping_costs_id');
    }

    /**
     * Relasi ke item pesanan
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
