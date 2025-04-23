<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'product_name', 'price', 'quantity', 'total'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function tire()
    {
        return $this->belongsTo(Tire::class, 'product_id');
    }
}
