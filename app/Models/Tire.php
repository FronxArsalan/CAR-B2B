<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tire extends Model
{
    use Notifiable;
    //
    protected $table = 'tires';
    protected $with = ['discounts'];

    protected $fillable = [
        'nr_article',
        'largeur',
        'hauteur',
        'diametre',
        'type',
        'vitesse',
        'marque',
        'profile',
        'saison',
        'quantite',
        'low_stock_threshold',
        'prix_pro',
        'prix',
        'etat',
        'lot',
        'mm',
        'dot',
        'rft'

    ];
    // Add this method to your Tire model
    public function getTireSizeAttribute()
    {
        return sprintf(
            "%s/%sR%s",
            $this->largeur,
            $this->hauteur,
            $this->diametre
        );
    }

    // Then you can access it anywhere as:
    // $tire->tire_size  // Output: "205/55R16"

    // Accessor (Optional) - Formatted Sale Price
    public function getFormattedSalePriceAttribute()
    {
        return number_format($this->prix, 2) . ' €';
    }


    // Scope (Optional) - Search by Mark
    public function scopeSearch($query, $term)
    {
        return $query->where('marque', 'like', '%' . $term . '%')
            ->orWhereRaw("CONCAT(largeur, '/', hauteur, 'R', diametre) LIKE ?", ["%{$term}%"]);
    }
    public function getDiscountedPrice($qty = 1)
    {
        $discount = $this->discounts()
            ->where('min_quantity', '<=', $qty)
            ->where(function ($q) {
                $today = now();
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', $today);
            })
            ->where(function ($q) {
                $today = now();
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', $today);
            })
            ->orderByDesc('discount_percent')
            ->first();

        if ($discount) {
            return round($this->prix - ($this->prix * $discount->discount_percent / 100), 2);
        }

        return $this->prix;
    }
    public function discounts()
{
    return $this->hasMany(Discount::class);
}

}
