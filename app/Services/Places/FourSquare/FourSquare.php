<?php

namespace App\Services\Places\FourSquare;

interface FourSquare
{
    public function venueSearch(string $cityName);
}
