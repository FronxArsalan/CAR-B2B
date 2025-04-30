<?php

namespace App\Http\Controllers;

use App\Services\GoogleSheetsService;
use Illuminate\Http\Request;

class GoogleSheetController extends Controller
{
    //
    protected $googleSheets;

    public function __construct(GoogleSheetsService $googleSheets)
    {
        $this->googleSheets = $googleSheets;
    }

    public function index()
    {
        $data['googldata'] = $this->googleSheets->readSheet();
        // mojhe last row ka data chahiye
        $data['googlelastdata'] = array_slice($data['googldata'], -1, 1);
        // mojhe last row ka id chahiye
        foreach ($data['googlelastdata'] as $key => $value) {
            $data['lastid'] = $value[5];
        }



        $data['tires'] = [];
        $key = 0;
        if ($data['googldata']) {
            foreach ($data['googldata'] as $index => $value) {
                if ($index == 0) {
                    continue; // Skip header row
                }
                // Assuming the data is in the format: [name, email, phone, created_at]
                // Adjust the indices based on your actual data structure
                if (count($value) < 4) {
                    continue; // Skip rows with insufficient data
                }

                // Map the values to your desired structure
                // dd($value); // For debugging, remove in production
                //
                // Assuming the first column is the ID, second is name, third is email, fourth is phone
                // and fifth is created_at
                $data['tires'][$key]['nr_article'] = $value[0];
                $data['tires'][$key]['largeur'] = $value[1];
                $data['tires'][$key]['hauteur'] = $value[2];
                $data['tires'][$key]['diametre'] = $value[3];

                $data['tires'][$key]['vitesse'] = $value[4];
                $data['tires'][$key]['marque'] = $value[5];
                $data['tires'][$key]['profile'] = $value[6];
                $data['tires'][$key]['lot'] = $value[7];
                $data['tires'][$key]['mm'] = $value[8];
                $data['tires'][$key]['dot'] = $value[9];
                $data['tires'][$key]['rft'] = $value[10];
                $data['tires'][$key]['saison'] = $value[11];
                $data['tires'][$key]['quantite'] = $value[12];
                $data['tires'][$key]['prix_pro'] = $value[13];
                $data['tires'][$key]['prix'] = $value[14];
                $data['tires'][$key]['etat'] = $value[15];
                $data['tires'][$key]['ID'] = $value[16];
                $key++;
            }
        }
        // dd($data['tires']); // For debugging, remove in production
        return view('admin.google-sheet.index', $data);
    }

    // create
    public function create()
    {
        $data['googldata'] = $this->googleSheets->readSheet();
        // mojhe last row ka data chahiye
        $data['googlelastdata'] = array_slice($data['googldata'], -1, 1);
        // mojhe last row ka id chahiye
        foreach ($data['googlelastdata'] as $key => $value) {
            $data['lastid'] = $value[16];
        }
        return view('admin.google-sheet.create', $data);
    }

    // store
    public function store(Request $request)
    {
        $data = $request->validate([
            'nr_article' => 'required',
            'largeur' => 'required|numeric',
            'hauteur' => 'required|numeric',
            'diametre' => 'required|numeric',
            'vitesse' => 'required|string',
            'marque' => 'required|string',
            'profile' => 'required|string',
            'lot' => 'required|string',
            'mm' => 'required|numeric',
            'dot' => 'required|string',
            'rft' => 'required|in:0,1',
            'saison' => 'required|string',
            'quantite' => 'required|integer|min:0',
            'prix_pro' => 'required|numeric',
            'prix' => 'required|numeric',

            // ✅ Discount array validation
            'discounts' => 'nullable|array',
            'discounts.*.min_quantity' => 'required_with:discounts.*.discount_percent|integer|min:1',
            'discounts.*.discount_percent' => 'required_with:discounts.*.min_quantity|numeric|min:0|max:100',
            'discounts.*.type' => 'required|in:general,seasonal',
            'discounts.*.season' => 'nullable|string',
            'discounts.*.start_date' => 'nullable|date',
            'discounts.*.end_date' => 'nullable|date|after_or_equal:discounts.*.start_date',
        ]);


        // Process the data if needed
        // dd($request->all());
        $rowData = [
            $request->nr_article,
            $request->largeur,
            $request->hauteur,
            $request->diametre,
            $request->vitesse,
            $request->marque,
            $request->profile,
            $request->lot,
            $request->mm,
            $request->dot,
            $request->rft,
            $request->saison,
            $request->quantite,
            $request->prix_pro,
            $request->prix,
            $request->etat,
            $request->ID + 1,
            $request->type,
            $request->low_stock_threshold,
        ];
        $this->googleSheets->appendRow($rowData);

        // Store to Discounts Sheet
        if ($request->filled('discounts')) {
            foreach ($request->discounts as $discount) {
                $discountRow = [
                    $request->ID + 1,
                    $discount['min_quantity'],
                    $discount['discount_percent'],
                    $discount['type'],
                    $discount['season'] ?? '',
                    $discount['start_date'] ?? '',
                    $discount['end_date'] ?? '',
                ];
                $this->googleSheets->appendRow($discountRow, 'discounts');
            }
        }
        return redirect()->route('google-sheet.index')
            ->with('success', __('Google Sheet row created successfully.'));
    }
    // edit
    public function edit($id)
    {
        $data['googldata'] = $this->googleSheets->readSheet();
        // mojhe last row ka data chahiye
        $data['googlelastdata'] = array_slice($data['googldata'], -1, 1);
        // mojhe last row ka id chahiye
        foreach ($data['googlelastdata'] as $key => $value) {
            $data['lastid'] = $value[16];
        }
        // dd($data['lastid']);
        $data['tire'] = [];
        $key = 0;
        if ($data['googldata']) {
            foreach ($data['googldata'] as $index => $value) {
                if ($index == 0) {
                    continue; // Skip header row
                }
                // Assuming the data is in the format: [name, email, phone, created_at]
                // Adjust the indices based on your actual data structure
                if (count($value) < 4) {
                    continue; // Skip rows with insufficient data
                }

                // Map the values to your desired structure
                // dd($value); // For debugging, remove in production
                //
                // Assuming the first column is the ID, second is name, third is email, fourth is phone
                // and fifth is created_at
                if ($value[16] == $id) {
                    $data['tire'][$key]['nr_article'] = $value[0];
                    $data['tire'][$key]['largeur'] = $value[1];
                    $data['tire'][$key]['hauteur'] = $value[2];
                    $data['tire'][$key]['diametre'] = $value[3];

                    $data['tire'][$key]['vitesse'] = $value[4];
                    $data['tire'][$key]['marque'] = $value[5];
                    $data['tire'][$key]['profile'] = $value[6];
                    $data['tire'][$key]['lot'] = $value[7];
                    $data['tire'][$key]['mm'] = $value[8];
                    $data['tire'][$key]['dot'] = $value[9];
                    $data['tire'][$key]['rft'] = $value[10];
                    $data['tire'][$key]['saison'] = $value[11];
                    $data['tire'][$key]['quantite'] = $value[12];
                    $data['tire'][$key]['prix_pro'] = $value[13];
                    $data['tire'][$key]['prix'] = $value[14];
                    $data['tire'][$key]['etat'] = $value[15];
                    $data['tire'][$key]['ID'] = $value[16];
                    $data['tire'][$key]['type'] = $value[17];
                    $data['tire'][$key]['low_stock_threshold'] = $value[18];
                    $data['tire'][$key]['discounts'] = [];
                    // Get discounts for this tire
                    $discounts = $this->googleSheets->readSheet('discounts');

                    foreach ($discounts as $disindex => $discount) {
                        if ($disindex == 0) {
                            continue; // Skip header row
                        }
                        // Assuming the first column is the ID, second is min_quantity, third is discount_percent, fourth is type
                        // and fifth is season, sixth is start_date, seventh is end_date
                        if (count($discount) < 7) {
                            continue; // Skip rows with insufficient data
                        }
                        // Map the values to your desired structure


                        if ($discount[0] == $id) {
                            $data['tire'][$key]['discounts'][] = [
                                'min_quantity' => $discount[1],
                                'discount_percent' => $discount[2],
                                'type' => $discount[3],
                                'season' => $discount[4],
                                'start_date' => $discount[5],
                                'end_date' => $discount[6],
                            ];
                        }
                    }
                    $key++;
                }
            }
        }
        // dd($data['tire']); // For debugging, remove in production
        return view('admin.google-sheet.edit', $data);
    }
    // update
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nr_article' => 'required',
            'largeur' => 'required|numeric',
            'hauteur' => 'required|numeric',
            'diametre' => 'required|numeric',
            'vitesse' => 'required|string',
            'marque' => 'required|string',
            'profile' => 'required|string',
            'lot' => 'required|string',
            'mm' => 'required|numeric',
            'dot' => 'required|string',
            'rft' => 'required|in:0,1',
            'saison' => 'required|string',
            'quantite' => 'required|integer|min:0',
            'prix_pro' => 'required|numeric',
            'prix' => 'required|numeric',

            // ✅ Discount array validation
            // Add your discount validation rules here
        ]);
        $rows = $this->googleSheets->readSheet();
        
        $rowNumber = null;
        foreach ($rows as $index => $row) {
            if ($index == 0) {
                continue; // Skip header row
            }

            // Ensure the row has sufficient data
            if (count($row) < 6) {
                continue; // Skip rows with insufficient data
            }

            // Check if the current row matches the given ID
            if ($index == $id) { // Assuming ID is in the 6th column (index 5)
                $rowNumber = $index; // Google Sheets uses 1-based indexing
                break; // Exit the loop once the matching row is found
            }
        }
        // dd($rowNumber);
        // Process the data if needed
        // dd($request->all());
        $rowData = [
            $request->nr_article,
            $request->largeur,
            $request->hauteur,
            $request->diametre,
            $request->vitesse,
            $request->marque,
            $request->profile,
            $request->lot,
            $request->mm,
            $request->dot,
            $request->rft,
            $request->saison,
            $request->quantite,
            $request->prix_pro,
            $request->prix,
            $request->etat,
            $id, // Use the ID from the route
        ];
        // Update the row in the Google Sheet
        $this->googleSheets->updateRow($rowNumber, $rowData);
        // delete discount by id
        $discounts = $this->googleSheets->readSheet('discounts');
        // dd($discounts);
        foreach ($discounts as $index => $row) {
            if ($index == 0) {
                continue; // Skip header row
            }

            // Ensure the row has sufficient data
            if (count($row) < 6) {
                continue; // Skip rows with insufficient data
            }

            // Check if the current row matches the given ID
            if ($row[0] == $id) { // Assuming ID is in the 6th column (index 5)
                $rowNumber = $index; // Google Sheets uses 1-based indexing
                break; // Exit the loop once the matching row is found
            }
        }
        if ($rowNumber) {
            $this->googleSheets->deleteRow($rowNumber, 'discounts');
        }
        // Store to Discounts Sheet
        if ($request->filled('discounts')) {
            foreach ($request->discounts as $discount) {
                $discountRow = [
                    $id,
                    $discount['min_quantity'],
                    $discount['discount_percent'],
                    $discount['type'],
                    $discount['season'] ?? '',
                    $discount['start_date'] ?? '',
                    $discount['end_date'] ?? '',
                ];
                $this->googleSheets->appendRow($discountRow, 'discounts');
            }
        }

        return redirect()->route('google-sheet.index')
            ->with('success', __('Google Sheet row updated successfully.'));
    }
    // destroy
    public function destroy($id)
    {

        $rows = $this->googleSheets->readSheet();
        $rowNumber = null;
        foreach ($rows as $index => $row) {
            if ($index == 0) {
                continue; // Skip header row
            }

            // Ensure the row has sufficient data
            if (count($row) < 6) {
                continue; // Skip rows with insufficient data
            }

            // Check if the current row matches the given ID
            if ($row[16] == $id) { // Assuming ID is in the 6th column (index 5)
                $rowNumber = $index; // Google Sheets uses 1-based indexing
                break; // Exit the loop once the matching row is found
            }
        }
        // dd($rowNumber);
        if ($rowNumber) {
            $this->googleSheets->deleteRow($rowNumber);
            // delete discount by id
            $discounts = $this->googleSheets->readSheet('discounts');
            // dd($discounts);
            foreach ($discounts as $index => $row) {
                if ($index == 0) {
                    continue; // Skip header row
                }

                // Ensure the row has sufficient data
                if (count($row) < 6) {
                    continue; // Skip rows with insufficient data
                }

                // Check if the current row matches the given ID
                if ($row[0] == $id) { // Assuming ID is in the 6th column (index 5)
                    $rowNumber = $index; // Google Sheets uses 1-based indexing
                    break; // Exit the loop once the matching row is found
                }
            }
            if ($rowNumber) {
                $this->googleSheets->deleteRow($rowNumber, 'discounts');
            }
            return redirect()->route('google-sheet.index')
                ->with('success', __('Google Sheet row deleted successfully.'));
        }

        // Agar match na mile
        return redirect()->back()->with('error', 'Product ID not found!');
    }
}
