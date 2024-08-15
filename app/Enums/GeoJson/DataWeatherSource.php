<?php

namespace App\Enums\GeoJson;

enum DataWeatherSource: int

{



    case API = 1;
    case USER = 2;
    case FERMIER = 3;



    public function text()
    {
        return match ($this) {
            self::API => 'API',
            self::USER => 'USER',
            self::FERMIER => 'FERMIER',

        };
    }

    public function class()
    {
        return match ($this) {
            self::API => 'primary',
            self::USER => 'light',
            self::FERMIER => 'warning',

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
