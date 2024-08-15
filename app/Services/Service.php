<?php

namespace App\Services;

use App\Interfaces\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

class Service implements ServiceInterface
{
    /***
    /**
     * Check if the specified column value is unique among other models except the current one.
     * This function queries the database to determine whether any other model has the same
     * @param Model $model
     * @param string $attr
     * @param string $value
     * @return bool
     */
    public static function isColumnValueUniqueExceptSelf(Model $model, string $attr, string $value): bool
    {
        return $model->newQuery()
            ->where('id', '!=', $model->id)
            ->where($attr, $value)
            ->count();
    }
}
