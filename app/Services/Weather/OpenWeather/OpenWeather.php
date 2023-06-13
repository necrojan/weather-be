<?php

namespace App\Services\Weather\OpenWeather;

interface OpenWeather
{
    public function getWeather(string $path, string $cityName);
}
