<?php

namespace App\Enums;

enum ModePayment: string
{

    case CAISSE = "C";
    case CHEQUE = "MH";
    case CARTE = "CA";

    public function text()
    {
        return match ($this) {
            self::CAISSE => trans('app.payment.caisse'),
            self::CHEQUE => trans('app.payment.cheque'),
            self::CARTE => trans('app.payment.carte'),
        };
    }

    public function class()
    {
        return match ($this) {
            self::CAISSE => "secondary",
            self::CHEQUE => "success",
            self::CARTE => "Warning",
        };
    }

    public static function toArray()
    {
        return [
            self::CAISSE->value => self::CAISSE->text(),
            self::CHEQUE->value => self::CHEQUE->text(),
            self::CARTE->value => self::CARTE->text(),
        ];
    }
}
