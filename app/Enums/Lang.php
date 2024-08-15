<?php

namespace App\Enums;

enum Lang: string
{

    case ARABIC = "ar";
    case FRENCH = "fr";
    case ENGLISH = "en";


    public function label(): string
    {
        return match ($this) {
            self::ARABIC => trans('app.lang.arabic'),
            self::FRENCH => trans('app.lang.french'),
            self::ENGLISH => trans('app.lang.english'),

        };
    }
    public function icon(): string
    {
        return match ($this) {
            self::ARABIC => asset("/assets/media/flags/morocco.svg"),
            self::FRENCH => asset("/assets/media/flags/france.svg"),
            self::ENGLISH => asset("/assets/media/flags/uk.svg"),

        };
    }



}
