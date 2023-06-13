<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetCityRequest;
use App\Services\Weather\OpenWeather\OpenWeather;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

class WeatherController extends Controller
{
    public function forecast(GetCityRequest $request, OpenWeather $openWeather): Response
    {
        return $openWeather->getWeather('/forecast', Str::ucfirst($request->get('city')));
    }

    public function current(GetCityRequest $request, OpenWeather $openWeather): Response
    {
        return $openWeather->getWeather('/weather', Str::ucfirst($request->get('city')));
    }
}
