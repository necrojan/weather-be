<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetCityRequest;
use App\Services\Places\FourSquare\FourSquare;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

class PlacesController extends Controller
{
    public function search(GetCityRequest $request, FourSquare $fourSquare): Response
    {
        return $fourSquare->venueSearch(Str::ucfirst($request->get('city')));
    }
}
