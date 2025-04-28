<?php

namespace App\Exports;

use App\Models\Tire;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Tire::all([
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
        ]);
    }
}
