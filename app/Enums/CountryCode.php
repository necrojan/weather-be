<?php

namespace App\Enums;

enum CountryCode
{
    case JP;

    public function initial(): string
    {
        return match ($this) {
            self::JP => 'JP'
        };
    }
}
