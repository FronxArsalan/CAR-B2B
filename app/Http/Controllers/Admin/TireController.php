<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tire;
use App\Rules\DotCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Tires';
        $data['tires'] = Tire::orderBy('created_at', 'desc')->get();
        return view('admin.tires.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Add New Tire';
        return view('admin.tires.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nr_article' => 'required|string|max:50|unique:tires,nr_article',
            'largeur' => 'required|integer|between:100,400',
            'hauteur' => 'required|integer|between:30,90',
            'diametre' => 'required|integer|between:10,24',
            'vitesse' => 'required|string|size:1|in:H,V,W,Y,Z',
            'marque' => 'required|string|max:50',
            'profile' => 'required|string|max:100',
            'saison' => 'required|string|in:Summer,Winter,All-Season',
            'quantite' => 'required|integer|min:0',
            'prix_pro' => 'required|numeric|min:0|lt:prix',
            'prix' => 'required|numeric|min:0|gt:prix_pro',
            'etat' => 'required|string|in:New,Used,Refurbished',
            'lot' => 'nullable|string|max:50',
            'mm' => 'nullable|numeric|between:1.6,10',
            'dot' => ['nullable', new DotCode],
            'rft' => 'nullable|boolean'
        ]);

        Tire::create($validated);

        return redirect()
            ->route('tires.index')
            ->with('success', 'Tire added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tire $tire)
    {
        $data['header_title'] = 'Edit Tire';
        $data['tire'] = $tire;
        return view('admin.tires.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tire $tire)
    {
        $validated = $request->validate([
            'nr_article' => 'required|string|max:50|unique:tires,nr_article,' . $tire->id,
            'largeur' => 'required|integer|between:100,400',
            'hauteur' => 'required|integer|between:30,90',
            'diametre' => 'required|integer|between:10,24',
            'vitesse' => 'required|string|size:1|in:H,V,W,Y,Z',
            'marque' => 'required|string|max:50',
            'profile' => 'required|string|max:100',
            'saison' => 'required|string|in:Summer,Winter,All-Season',
            'quantite' => 'required|integer|min:0',
            'prix_pro' => 'required|numeric|min:0|lt:prix',
            'prix' => 'required|numeric|min:0|gt:prix_pro',
            'etat' => 'required|string|in:New,Used,Refurbished',
            'lot' => 'nullable|string|max:50',
            'mm' => 'nullable|numeric|between:1.6,10',
            'dot' => ['nullable', new DotCode],
            'rft' => 'nullable|boolean',
        ]);

        $tire->update($validated);

        return redirect()
            ->route('tires.index')
            ->with('success', 'Tire updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tire $tire)
    {
        $tire->delete();

        return redirect()
            ->route('tires.index')
            ->with('success', 'Tire deleted successfully!');
    }

    public function inventory()
    {
        $data = [
            'header_title' => 'Inventory Management',
            'lowStock' => Tire::where('quantite', '<', 5)
                ->orderBy('quantite')
                ->get(),
            'outOfStock' => Tire::where('quantite', 0)->get(),
            'stockSummary' => DB::table('tires')
                ->selectRaw('
                              COUNT(*) as total_items,
                              SUM(quantite) as total_stock,
                              SUM(CASE WHEN quantite < 5 THEN 1 ELSE 0 END) as low_stock_count
                          ')
                ->first()
        ];
        return view('admin.tires.inventory', $data);
    }
}
