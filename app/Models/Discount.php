<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $fillable = [
        'tire_id',
        'min_quantity',
        'discount_percent',
        'type',
        'season',
        'start_date',
        'end_date',
    ];
    
    //
    public function tire()
{
    return $this->belongsTo(Tire::class);
}
public function discounts()
{
    return $this->hasMany(Discount::class);
}

}
