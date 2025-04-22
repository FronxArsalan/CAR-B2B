<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tire extends Model
{
    use Notifiable;
    //
    protected $table = 'tires';

    protected $fillable = [
        'nr_article',
        'largeur',
        'hauteur',
        'diametre',
        'vitesse',
        'marque',
        'profile',
        'saison',
        'quantite',
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
        return number_format($this->sale_price, 2) . ' €';
    }

    // Scope (Optional) - Search by Mark
    public function scopeSearch($query, $term)
    {
        return $query->where('mark', 'like', '%' . $term . '%')
            ->orWhere('tire_size', 'like', '%' . $term . '%');
    }
}
