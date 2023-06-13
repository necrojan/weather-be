<?php

namespace App\Services\Places\FourSquare;

use Illuminate\Support\ServiceProvider;

class FourSquareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(FourSquare::class, FourSquareImpl::class);
    }
}
