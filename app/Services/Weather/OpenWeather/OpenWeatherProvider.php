<?php

namespace App\Services\Weather\OpenWeather;

use Illuminate\Support\ServiceProvider;

class OpenWeatherProvider extends ServiceProvider
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
        $this->app->bind(OpenWeather::class, OpenWeatherImpl::class);
    }
}
