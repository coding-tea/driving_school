<?php

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

enum BusinessCategory: int
{
    case Manufacturer = 1;
    case Distributor  = 2;
    case ManufacturerDistributor = 3;

    public function text(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::Manufacturer => trans('stock_management.business_categories.manufacturer'),
            self::Distributor => trans('stock_management.business_categories.distributor'),
            self::ManufacturerDistributor => trans('stock_management.business_categories.manufacturer_distributor')
        };
    }



    public static function toArray(): array
    {
        return [
            self::Manufacturer->value => self::Manufacturer->text(),
            self::Distributor->value => self::Distributor->text(),
            self::ManufacturerDistributor->value => self::ManufacturerDistributor->text()
        ];
    }
}