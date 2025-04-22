<?php

namespace App\Observers;

use App\Models\Tire;
use App\Models\User;
use App\Notifications\LowStockNotification;
use Illuminate\Support\Facades\Notification;

class TireObserver
{
    /**
     * Handle the Tire "created" event.
     */
    public function created(Tire $tire): void
    {
        $this->checkStockLevels($tire);
    }

    /**
     * Handle the Tire "updated" event.
     */
    public function updated(Tire $tire): void
    {
        // Only check if quantity was changed
        if ($tire->isDirty('quantite')) {
            $this->checkStockLevels($tire);
        }
    }

    /**
     * Check stock levels and send notifications if low
     */
    protected function checkStockLevels(Tire $tire): void
    {
        $threshold = config('tires.low_stock_threshold', 5);
        
        if ($tire->quantite < $threshold) {
            // Get admin users who should be notified
            $admins = User::where('email', 'admin@gmail.com')->get();
            
            Notification::send($admins, new LowStockNotification($tire));
        }
    }
}