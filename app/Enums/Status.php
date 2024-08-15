<?php

namespace App\Enums;

enum Status: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
    case BLOCKED = 2;


    public function text()
    {
        return match ($this) {
            self::ACTIVE => trans('users.status.active'),
            self::INACTIVE => trans('users.status.inactive'),
            self::BLOCKED =>trans('users.status.blocked'),
        };
    }

    public function class()
    {
        return match ($this) {
            self::ACTIVE =>   'success',
            self::INACTIVE => 'warning',
            self::BLOCKED =>  'danger',
        };
    }

    public static function toArray(){
        return [
            self::INACTIVE->value => self::INACTIVE->text(),
            self::ACTIVE->value => self::ACTIVE->text(),
            self::BLOCKED->value => self::BLOCKED->text(),
        ];
    }


}
