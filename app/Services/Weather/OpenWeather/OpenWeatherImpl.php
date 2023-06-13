<?php

namespace App\Services\Weather\OpenWeather;

use App\Enums\CountryCode;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class OpenWeatherImpl implements OpenWeather
{
    private string $baseUrl;

    private CountryCode $countryCode = CountryCode::JP;

    public function __construct()
    {
        $this->baseUrl = config('open-weather.base_url');
    }

    public function getWeather(string $path, string $cityName): Response
    {
        return Http::get($this->getBaseUrl() . $path, [
            'q' => $cityName . ',' . $this->countryCode->initial(),
            'units' => 'metric',
            'appId' => config('open-weather.key')
        ]);
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }


}
