<?php

namespace App\Mixins;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CollectionMixin
{

    public function removeByModel(?Collection $collection = null, ?Model $model = null)
    {
        return function ($collection , $model) {
            return $collection->reject(function ($item) use ($model) {
                return $item->getKey() === $model->getKey();
            });
        };

    }
}
