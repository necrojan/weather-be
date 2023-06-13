<?php

namespace App\Services\Places\FourSquare;

use App\Enums\CountryCode;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FourSquareImpl implements FourSquare
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('places.foursquare_base_url');
    }

    public function venueSearch(string $cityName): Response
    {
        $japan = CountryCode::JP;

        return Http::withHeaders($this->additionalHeaders())
            ->get($this->getBaseUrl() . '/places/search', [
                'near' => $cityName . ',' . $japan->initial(),
            ]);
    }

    public function placePhotos(string $fsqId): Response
    {
        return Http::withHeaders($this->additionalHeaders())
            ->get($this->getBaseUrl() . '/places/fsq_id/photos', [
                'fsq_id' => $fsqId
            ]);
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    private function additionalHeaders(): array
    {
        return [
            'Authorization' => config('places.foursquare_api_key')
        ];
    }
}
