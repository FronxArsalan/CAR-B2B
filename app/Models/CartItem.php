<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $fillable = ['user_id', 'tire_id', 'quantity', 'price'];

    public function tire()
    {
        return $this->belongsTo(Tire::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
