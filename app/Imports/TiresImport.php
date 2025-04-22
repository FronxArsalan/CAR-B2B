<?php

namespace App\Imports;

use App\Models\Tire;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class TiresImport implements ToModel, WithHeadingRow

{
  
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Step 1: Clean header keys — lowercase + trim
        $cleanRow = [];
        foreach ($row as $key => $value) {
            if ($key === null) continue; // skip null header columns
            $cleanKey = strtolower(trim($key));
            $cleanRow[$cleanKey] = trim($value);
        }
        
        // Step 2: Now access cleanRow safely
        $cleanPrice = function ($price) {
            return (float) str_replace(['€', ' '], '', $price);
        };
        
        return new Tire([
            'nr_article' => $cleanRow['nr_article'],
            'largeur' => $cleanRow['largeur'] ?? null,
            'hauteur' => $cleanRow['hauteur'] ?? null,
            'diametre' => $cleanRow['diametre'] ?? null,
            'type' => $cleanRow['type'] ?? null,
            'vitesse' => $cleanRow['vitesse'] ?? null,
            'marque' => $cleanRow['marque'] ?? null,
            'profile' => $cleanRow['profile'] ?? null,
            'saison' => $cleanRow['saison'] ?? null,
            'quantite' => $cleanRow['quantite'] ?? 0,
            'prix_pro' => $cleanPrice($cleanRow['prix_pro'] ?? 0),
            'prix' => $cleanPrice($cleanRow['prix'] ?? 0),
            'etat' => $cleanRow['état'] ?? 'neuf',
            'lot' => $cleanRow['lot'] ?? null,
            'mm' => is_numeric($cleanRow['mm'] ?? null) ? $cleanRow['mm'] : null,
            'dot' => $cleanRow['dot'] ?? null,
            'rft' => in_array(strtolower($cleanRow['rft?'] ?? ''), ['yes', 'oui']) ? 1 : 0,
        ]);

    }
    
}
