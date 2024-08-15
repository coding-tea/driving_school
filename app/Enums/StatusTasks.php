<?php

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

enum StatusTasks: String
{
    case Impacte = 'A';
    case InProgress = 'EC';
    case Delivered= 'LQ';
    case In_Qualification = 'Q';
    case Defect = 'D';
    case Closed = 'S';
    case Canceled = 'AN';

    public function text(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {

            self::Impacte =>trans('task.status.impacte'),
            self::InProgress =>trans('task.status.inprogress'),
            self::Delivered =>trans('task.status.delivered'),
            self::In_Qualification =>trans('task.status.in_qualification'),
            self::Defect =>trans('task.status.defect'),
            self::Closed =>trans('task.status.closed'),
            self::Canceled =>trans('task.status.canceled'),
        };
    }

    public function class(): string
    {
        return match ($this) {
            self::Impacte => 'badge badge-light-warning',
            self::InProgress => 'badge badge-light-dark',
            self::Delivered => 'badge badge-light-info',
            self::In_Qualification => 'badge badge-light-secondary',
            self::Defect => 'badge badge-light-success',
            self::Closed => 'badge badge-light-primary',
            self::Canceled => 'badge badge-light-danger',
        };
    }

    public static function toArray(): array
    {
        return [
            self::Impacte->value => self::Impacte->text(),
            self::InProgress->value => self::InProgress->text(),
            self::Delivered->value => self::Delivered->text(),
            self::In_Qualification->value => self::In_Qualification->text(),
            self::Defect->value => self::Defect->text(),
            self::Closed->value => self::Closed->text(),
            self::Canceled->value => self::Canceled->text(),
        ];
    }


    public static function statusOption():array
    {
        $data = [];
        foreach (self::cases() as $case) {
            $class = $case->class() ;
            $text = $case->text() ;
            $data[$case->value] = "<span class='$class'> $text </span>" ;
        }

        return $data;
    }

}
