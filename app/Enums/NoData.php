<?php

namespace App\Enums;

enum NoData
{

    case NO_DATA;

    public function label(): string
    {
        return match ($this) {
            self::NO_DATA => trans('app.no_data'),
        };
    }




}
