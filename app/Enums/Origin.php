<?php

namespace App\Enums;

enum Origin: String
{
    case Local = "L";
    case Import = "I";


    public function text()
    {
        return match ($this) {
            self::Local => trans('stock_management.origin.import'),
            self::Import => trans('stock_management.origin.export'),
        };
    }

    public function class()
    {
        return match ($this) {
            self::Local =>   'primary',
            self::Import => 'secondary',
        };
    }

    public static function toArray()
    {
        return [
            self::Local->value => self::Local->text(),
            self::Import->value => self::Import->text(),
        ];
    }
}