<?php

namespace App\Enums\GeoJson;

enum FeatureType: int

{

    case POSITION = 1;
    case MULTIPOINT = 2;
    case LINESTRING = 3;
    case MULTILINESTRING = 4;
    case POLYGON = 5;
    case MULTIPOLYGON = 6;
    case GEOMETRYCOLLECTION = 7;
    case ANTIMERIDIAN8_CUTTING = 8;
    case UNCERTAINTY_AND_PRECISION = 9;


    public function text()
    {
        return match ($this) {
            self::POSITION => 'POSITION',
            self::MULTIPOINT => 'MULTIPOINT',
            self::LINESTRING => 'LINESTRING',
            self::MULTILINESTRING => 'MULTILINESTRING',
            self::POLYGON => 'POLYGON',
            self::MULTIPOLYGON => 'MULTIPOLYGON',
            self::GEOMETRYCOLLECTION => 'GEOMETRYCOLLECTION',
            self::ANTIMERIDIAN8_CUTTING => 'ANTIMERIDIAN8_CUTTING',
            self::UNCERTAINTY_AND_PRECISION => 'UNCERTAINTY_AND_PRECISION',
        };
    }

    public function class()
    {
        return match ($this) {
            self::POSITION => 'POSITION',
            self::MULTIPOINT => 'MULTIPOINT',
            self::LINESTRING => 'LINESTRING',
            self::MULTILINESTRING => 'MULTILINESTRING',
            self::POLYGON => 'POLYGON',
            self::MULTIPOLYGON => 'MULTIPOLYGON',
            self::GEOMETRYCOLLECTION => 'GEOMETRYCOLLECTION',
            self::ANTIMERIDIAN8_CUTTING => 'ANTIMERIDIAN8_CUTTING',
            self::UNCERTAINTY_AND_PRECISION => 'UNCERTAINTY_AND_PRECISION',
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
