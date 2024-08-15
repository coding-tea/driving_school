<?php

namespace App\Enums;

enum Nationalite: string
{
    case MOROCCAN ='M';
    case FOREIGN = 'F';

    public  function text()
    {
        return match ($this) {
            // self::MOROCCAN => trans('app.moroccan'),
            // self::FOREIGN => trans('app.foreign'),
            self::MOROCCAN => 'moroccan',
            self::FOREIGN => 'foreign',
        };
    }

    public static function toArray(){
        return [
          self::MOROCCAN->value => self::MOROCCAN->text(),
          self::FOREIGN->value => self::FOREIGN->text(),
        ];
    }

}
