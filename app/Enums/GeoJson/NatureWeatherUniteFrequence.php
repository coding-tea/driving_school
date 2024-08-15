<?php

namespace App\Enums\GeoJson;

use App\Traits\GeoJson\Geo;

enum NatureWeatherUniteFrequence: int{
    case DAY = 0;
    case HOUR = 1;


    public function text()
    {
        return match ($this) {
            self::DAY => 'DAY',
            self::HOUR => 'HOUR'
        };
    }

    public function class()
    {
        return match ($this) {
            self::DAY => 'primary',
            self::HOUR => 'light'
        };
    }

    public static function toArray()
    {
        $cases = [];
        foreach (self::cases() as $case) {
            $cases[$case->value] = $case->text();
        }
        return $cases;

    }
}
