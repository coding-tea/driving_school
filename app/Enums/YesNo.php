<?php

namespace App\Enums;

enum YesNo : int
{
    case YES = 1;
    case NO = 0;


    public function text()
    {
        return match ($this) {
            self::YES =>trans('app.yes'),
            self::NO => trans('app.no'),

        };
    }


    public static function toArray(){
        return [
            self::YES->value => self::YES->text(),
            self::NO->value => self::NO->text(),
        ];
    }

    public function class()
    {
        return match ($this) {
            self::YES =>   'success',
            self::NO => 'warning'
        };
    }





}
