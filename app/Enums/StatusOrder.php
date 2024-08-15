<?php

namespace App\Enums;

enum StatusOrder: string
{
    case In_Progress = "IP";
    case Partially_Delivered = "PD";
    case Canceled_by_Company = "CBC";
    case Canceled_by_Supplier = "CBS";
    case  Fully_Delivered = "FD";


    public function text()
    {
        return match ($this) {
            self::In_Progress => trans('stock_management.status_cmd.ip'),
            self::Partially_Delivered => trans('stock_management.status_cmd.pd'),
            self::Canceled_by_Company => trans('stock_management.status_cmd.cbc'),
            self::Canceled_by_Supplier => trans('stock_management.status_cmd.cbs'),
            self::Fully_Delivered => trans('stock_management.status_cmd.fd'),
        };
    }

    public function class()
    {
        return match ($this) {
            self::In_Progress => 'primary', // blue
            self::Partially_Delivered => 'warning', // yellow
            self::Canceled_by_Company => 'danger', // red
            self::Canceled_by_Supplier => 'danger', // red
            self::Fully_Delivered => 'success', // green
        };
    }

    public static function toArray()
    {
        return [
            self::In_Progress->value => self::In_Progress->text(),
            self::Partially_Delivered->value => self::Partially_Delivered->text(),
            self::Canceled_by_Company->value => self::Canceled_by_Company->text(),
            self::Canceled_by_Supplier->value => self::Canceled_by_Supplier->text(),
            self::Fully_Delivered->value => self::Fully_Delivered->text(),
        ];
    }
}
