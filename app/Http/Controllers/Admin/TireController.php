<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tire;
use App\Rules\DotCode;
use App\Imports\TiresImport;
use Illuminate\Http\Request;
use App\Jobs\ProductImportJob;
use App\Exports\ProductsExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

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

        $tire = Tire::create($validated);
        if ($request->has('discounts')) {
            $tire->discounts()->delete(); // remove old ones

            foreach ($request->discounts as $data) {
                if (!empty($data['min_quantity']) && !empty($data['discount_percent'])) {
                    $tire->discounts()->create([
                        'min_quantity' => $data['min_quantity'],
                        'discount_percent' => $data['discount_percent'],
                        'type' => $data['type'] ?? 'general',
                        'season' => $data['season'] ?? null,
                        'start_date' => $data['start_date'] ?? null,
                        'end_date' => $data['end_date'] ?? null,
                    ]);
                }
            }
        }

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
        if ($request->has('discounts')) {
            $tire->discounts()->delete(); // remove old ones

            foreach ($request->discounts as $data) {
                if (!empty($data['min_quantity']) && !empty($data['discount_percent'])) {
                    $tire->discounts()->create([
                        'min_quantity' => $data['min_quantity'],
                        'discount_percent' => $data['discount_percent'],
                        'type' => $data['type'] ?? 'general',
                        'season' => $data['season'] ?? null,
                        'start_date' => $data['start_date'] ?? null,
                        'end_date' => $data['end_date'] ?? null,
                    ]);
                }
            }
        }

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

    // showImportForm
    public function showImportForm()
    {
        $data['header_title'] = 'Import Tires';
        return view('admin.tires.import', $data);
    }
    // import
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new TiresImport, $request->file('file'));
        return redirect()->route('tires.index')->with('success', 'Products imported successfully!');
    }

    // search
    public function search(Request $request)
    {
        $query = Tire::query();

        if ($request->filled('tire_size')) {
            $query->where('tire_size', 'like', '%' . $request->tire_size . '%');
        }

        if ($request->filled('mark')) {
            $query->where('mark', 'like', '%' . $request->mark . '%');
        }

        // Saison multiple values
        if ($request->filled('saison')) {
            $query->whereIn('saison', $request->saison);
        }

        $tires = $query->get();

        return view('admin.tires.search', compact('tires'));
    }


    public function exportProducts()
    {
        return Excel::download(new ProductsExport, 'updated_products.xlsx');
    }

    public function syncProductsManually()
    {
        Log::info('Sync Products Manually Triggered');
        ProductImportJob::dispatch();
        Log::info('Sync Products Manually Job Dispatched');
        return back()->with('status', 'Sync started!');
    }

    public function fetchSheetData()
    {
        $spreadsheetId = '1bgHea4A1qaRu0tpXZQXCf04nzI2_W1gHvDqv6lhuAec';
        $sheetName = 'Sheet1';

        try {
            // Validate input
            if (empty($spreadsheetId) || empty($sheetName)) {
                throw new \InvalidArgumentException('Spreadsheet ID and sheet name are required');
            }

            $url = "https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:json&sheet={$sheetName}";
            $response = Http::timeout(30)->get($url);

            if (!$response->successful()) {
                throw new \RuntimeException(
                    "Failed to fetch Google Sheet data. Status: {$response->status()}",
                    $response->status()
                );
            }

            $data = $this->parseResponse($response->body());
            $importResults = $this->processSheetData($data);

            return redirect()
                ->route('tires.index')
                ->with([
                    'success' => "Successfully imported {$importResults['success_count']} products",
                    'errors' => $importResults['errors']
                ]);
        } catch (\Exception $e) {
            Log::error('Google Sheets import failed: ' . $e->getMessage(), [
                'exception' => $e,
                'spreadsheetId' => $spreadsheetId,
                'sheetName' => $sheetName
            ]);

            return redirect()
                ->route('tires.index')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    protected function parseResponse(string $body): array
    {
        $json = $this->extractJsonFromResponse($body);
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        if (!isset($data['table']['rows'])) {
            throw new \RuntimeException('Invalid data structure - missing rows');
        }

        return $data;
    }

    protected function extractJsonFromResponse(string $body): string
    {
        $jsonStart = strpos($body, '{');
        $jsonEnd = strrpos($body, '}');

        if ($jsonStart === false || $jsonEnd === false) {
            throw new \RuntimeException('Invalid Google Sheets API response format');
        }

        $json = substr($body, $jsonStart, $jsonEnd - $jsonStart + 1);

        if (empty($json)) {
            throw new \RuntimeException('Empty JSON response');
        }

        return $json;
    }

    protected function processSheetData(array $data): array
    {
        // Corrected column mapping based on your $fillable
        $columnMapping = [
            0 => 'nr_article',
            1 => 'largeur',
            2 => 'hauteur',
            3 => 'diametre',
            4 => 'vitesse',
            5 => 'marque',
            6 => 'profile',
            7 => 'lot',
            8 => 'mm',
            9 => 'dot',
            10 => 'rft',
            11 => 'saison',
            12 => 'quantite',
            13 => 'prix_pro',
            14 => 'prix',
            15 => 'etat',
            16 => 'ID',

        ];

        $results = [
            'success_count' => 0,
            'errors' => []
        ];

        foreach ($data['table']['rows'] as $rowIndex => $row) {
            try {
                if (empty($row['c'])) {
                    $results['errors'][$rowIndex] = 'Empty row data';
                    continue;
                }

                $attributes = $this->mapRowData($row['c'], $columnMapping);

                // Validate required fields
                if (empty($attributes['nr_article'])) {
                    $results['errors'][$rowIndex] = 'Missing nr_article';
                    continue;
                }

                // Set default for low_stock_threshold if empty
                if (empty($attributes['low_stock_threshold'])) {
                    $attributes['low_stock_threshold'] = 5; // Default value
                }

                Tire::updateOrCreate(
                    ['nr_article' => $attributes['nr_article']],
                    $attributes
                );

                $results['success_count']++;
            } catch (\Exception $e) {
                $results['errors'][$rowIndex] = $e->getMessage();
                Log::warning("Failed to import row {$rowIndex}: " . $e->getMessage(), [
                    'rowData' => $row,
                    'exception' => $e
                ]);
            }
        }

        return $results;
    }

    protected function mapRowData(array $rowData, array $mapping): array
    {
        // dd($rowData,$mapping);
        $result = [];
        $maxIndex = count($rowData) - 1;

        foreach ($mapping as $index => $field) {
            try {
                // Skip if column doesn't exist in sheet
                if ($index > $maxIndex) {
                    $result[$field] = null;
                    continue;
                }

                $value = $rowData[$index]['v'] ?? null;

                $result[$field] = match ($field) {
                    'rft' => $this->parseBoolean($value),
                    'prix_pro', 'prix' => $this->parsePrice($value),
                    'quantite', 'low_stock_threshold' => (int)($value ?? 0),
                    default => $value
                };
                // dd($result);
            } catch (\Exception $e) {
                Log::debug("Error processing field {$field} at index {$index}", [
                    'value' => $value ?? null,
                    'exception' => $e
                ]);
                $result[$field] = null;
            }
        }

        return $result;
    }

    protected function parseBoolean($value): bool
    {
        if (is_bool($value)) return $value;
        if (is_numeric($value)) return (bool)$value;

        $value = strtolower(trim((string)$value));
        return in_array($value, ['yes', 'true', '1', 'y', 'oui']);
    }

    protected function parsePrice($value): float
    {
        if (is_numeric($value)) return (float)$value;
        return (float)preg_replace('/[^\d\.]/', '', (string)$value);
    }
}
