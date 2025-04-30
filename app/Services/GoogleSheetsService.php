<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetsService
{
    protected $client;
    protected $service;
    protected $spreadsheetId;
    protected $sheetName;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/google-service-account.json'));
        $this->client->addScope(Sheets::SPREADSHEETS);
        $this->service = new Sheets($this->client);

        // Set your Google Sheet ID and sheet name
        $this->spreadsheetId = '1bgHea4A1qaRu0tpXZQXCf04nzI2_W1gHvDqv6lhuAec';
        $this->sheetName = 'Sheet1'; // or your sheet name
    }
    protected function getSheetIdByName($sheetName)
    {
        $response = $this->service->spreadsheets->get($this->spreadsheetId);
        foreach ($response->getSheets() as $sheet) {
            if ($sheet->getProperties()->getTitle() === $sheetName) {
                return $sheet->getProperties()->getSheetId();
            }
        }

        throw new \Exception("Sheet '{$sheetName}' not found.");
    }
    public function readSheet($sheet_name = null)
    {
        if ($sheet_name) {
            $this->sheetName = $sheet_name; // Update the sheet name if provided
        }
        $range = $this->sheetName;
        $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
        return $response->getValues();
    }

    public function appendRow($data, $sheet_name = null)
    {
        if ($sheet_name) {
            $this->sheetName = $sheet_name; // Update the sheet name if provided
        }
        $range = $this->sheetName;
        $body = new ValueRange(['values' => [$data]]);
        $params = ['valueInputOption' => 'RAW'];

        return $this->service->spreadsheets_values->append(
            $this->spreadsheetId,
            $range,
            $body,
            $params
        );
    }

    public function updateRow($rowNumber, $data)
    {

        // Ensure $data is an array of values to update
        if (!is_array($data)) {
            throw new \InvalidArgumentException('Data must be an array.');
        }
        // Ensure $rowNumber is a valid integer
        if (!is_int($rowNumber) || $rowNumber < 1) {
            throw new \InvalidArgumentException('Row number must be a positive integer.');
        }
        $rowNumber = $rowNumber + 1; // Google Sheets API uses 1-based indexing
        // dd($rowNumber);
        $range = $this->sheetName . '!A' . $rowNumber . ':Z' . $rowNumber;
        $body = new ValueRange(['values' => [$data]]);
        $params = ['valueInputOption' => 'RAW'];

        return $this->service->spreadsheets_values->update(
            $this->spreadsheetId,
            $range,
            $body,
            $params
        );
    }

   public function deleteRow($rowNumber, $sheetName = null)
{
    $rowNumber = $rowNumber + 1; // Google Sheets API uses 1-based indexing
    $sheetName = $sheetName ?? $this->sheetName;
    $sheetId = $this->getSheetIdByName($sheetName);

    $requestBody = new Sheets\BatchUpdateSpreadsheetRequest([
        'requests' => [
            'deleteDimension' => [
                'range' => [
                    'sheetId' => $sheetId,
                    'dimension' => 'ROWS',
                    'startIndex' => $rowNumber - 1,
                    'endIndex' => $rowNumber
                ]
            ]
        ]
    ]);

    return $this->service->spreadsheets->batchUpdate(
        $this->spreadsheetId,
        $requestBody
    );
}
}
