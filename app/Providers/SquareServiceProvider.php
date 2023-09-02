<?php

namespace App\Providers;

use Square\SquareClient;
use Illuminate\Support\ServiceProvider;

class SquareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SquareClient::class, function () {
            return new SquareClient(config('square'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
