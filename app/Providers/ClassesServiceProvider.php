<?php

namespace App\Providers;

use App\Services\ClassesService;
use Illuminate\Support\ServiceProvider;

class ClassesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClassesService::class, function ($app) {
            return new ClassesService();
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
