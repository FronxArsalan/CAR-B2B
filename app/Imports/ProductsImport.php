<?php

namespace App\Imports;

use App\Models\Tire;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        return new Tire::updateOrCreate(
            ['nr_article' => $row['nr article']], // Matching field
            [
                'largeur'     => $row['Largeur'],
                'hauteur'     => $row['hauteur'],
                'diametre'    => $row['diamétre'],
                'vitesse'     => $row['vitesse'],
                'marque'      => $row['marque'],
                'profile'     => $row['profile'],
                'saison'      => $row['saison'],
                'quantite'    => $row['quantité'],
                'lot'         => $row['lot'],
                'mm'          => $row['mm'],
                'dot'         => $row['dot'],
                'rft'         => strtolower(trim($row['rft?'])) === 'yes' ? 1 : 0, // Convert to boolean
                'etat'        => $row['état'],
                'prix_pro'    => floatval(str_replace(['€', ' '], '', $row['prix pro'])),
                'prix'        => floatval(str_replace(['€', ' '], '', $row['prix'])),
            ]
        );
    }
}
