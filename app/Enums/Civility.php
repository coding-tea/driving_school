<?php

namespace App\Enums;

enum Civility: string
{

    case Celibataire = "C";
    case Marie = "M";
    case Divorce = "D";
    case Veuf = "V";


    public function text()
    {
        return match ($this) {
            self::Celibataire => trans('users.civility.single'),
            self::Marie => trans('users.civility.married'),
            self::Divorce => trans('users.civility.divorced'),
            self::Veuf => trans('users.civility.widowed'),
        };
    }

    public function class()
    {
        return match ($this) {
            self::Celibataire => "secondary",
            self::Marie => "success",
            self::Divorce => "Warning",
            self::Veuf => "dark",
        };
    }

    public static function toArray()
    {
        return [
            self::Celibataire->value => self::Celibataire->text(),
            self::Marie->value => self::Marie->text(),
            self::Divorce->value => self::Divorce->text(),
            self::Veuf->value => self::Veuf->text(),
        ];
    }

}
