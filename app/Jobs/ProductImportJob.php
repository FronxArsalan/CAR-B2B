<?php

namespace App\Jobs;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ProductImportJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('ProductImportJob started.');

        try {
            $fileUrl = 'https://1drv.ms/x/c/0e26be76f912ca6b/EW4WYEabmlFAgxy_SXHfXKwBhjpIrw2WCxHyfcrMxKCoLg';
            $tempPath = storage_path('app/temp_products.xlsx');

            $fileContent = @file_get_contents($fileUrl);

            if (!$fileContent) {
                throw new \Exception("Failed to download file from URL: $fileUrl");
            }

            file_put_contents($tempPath, $fileContent);

            Excel::import(new ProductsImport, $tempPath);

            Log::info('ProductImportJob completed successfully.');
        } catch (\Exception $e) {
            Log::error('ProductImportJob failed.', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
