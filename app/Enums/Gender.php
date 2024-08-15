<?php

namespace App\Enums;

enum Gender: string
{
    case MAN ='M';
    case WOMAN = 'W';

    public  function text()
    {
        return match ($this) {
            self::MAN => trans('app.man'),
            self::WOMAN => trans('app.woman'),
        };
    }
    public  function class()
    {
        return match ($this) {
            self::MAN => "primary",
            self::WOMAN => "success",
        };
    }

    public  function icon()
    {
        return match ($this) {
            self::MAN => '<i class="fa-solid text-success fa-person " style="font-size: 1.5rem !important;"></i>',
            self::WOMAN => '<i class="fa-solid text-warning fa-female " style="font-size: 1.5rem !important;"></i>',
        };
    }

    public static function toArray(){
        return [
          self::MAN->value => self::MAN->text(),
          self::WOMAN->value => self::WOMAN->text(),
        ];
    }

}
