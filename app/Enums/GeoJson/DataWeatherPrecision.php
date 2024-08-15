<?php

namespace App\Enums\GeoJson;

enum DataWeatherPrecision: int

{


    case CDA = 1;
    case CM = 2;
    case F =  3;



    public function text()
    {
        return match ($this) {
            self::CDA => 'CDA',
            self::CM => 'Commune',
            self::F => 'Ferme',

        };
    }

    public function class()
    {
        return match ($this) {
            self::CDA => 'primary',
            self::CM => 'light',
            self::F => 'warning',

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
