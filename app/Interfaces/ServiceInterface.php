<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    /****
     * check if column table value exist execpt cuurent model
     * @param Model $model
     * @param $attr
     * @param $value
     * @return bool
     */
    public static  function  isColumnValueUniqueExceptSelf(Model $model , string $attr ,string $value):bool;
}
