<?php

namespace App\View;

use Illuminate\Support\Collection;

class FormDataBinder
{
    /**
     * Tree of bound targets.
     */
    private static $binding;


    /*
     * bind the data
     */
    public static function bind($bindings): void
    {
        self::$binding = $bindings;
    }

    /*
       * check if the bounded data is collection
       */
    public static function isCollection(): bool
    {
        return self::$binding instanceof Collection;
    }

    /*
           * get the bounded data
   */
    public static function get()
    {
        return self::$binding;
    }

    /*
       * destroy data
       */
    public static function end(): void
    {
        self::$binding = null;
    }
}
