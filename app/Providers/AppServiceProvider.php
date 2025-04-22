<?php

namespace App\Providers;

use App\Models\Tire;
use App\Observers\TireObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Tire::observe(TireObserver::class);
    }
}
