<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'shipping_address', 'shipping_city',
        'shipping_state', 'shipping_zip', 'shipping_country',
        'billing_address', 'billing_city', 'billing_state', 'billing_zip', 'billing_country',
        'payment_method', 'total', 'order_date', 'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

