<?php

namespace App\Traits;

trait Consultable
{


    /***
     * Filter edit consult requirements
     * @param $method
     * @param $serachBy
     * @param $keys
     * @return array
     * @throws \Exception
     */
    public static function get($method, $serachBy, $keys)
    {
        if(!method_exists(static::class,$method)){
            throw new \Exception("function ($method) not exists in " . static::class);
        }

        $serachBy = 'get'.ucfirst($serachBy);
        $data = (new static)->$method();
        $searched = [];
        foreach ($data as $datum) {

            if (is_array($keys) && in_array($datum->$serachBy(), $keys)) {
                $searched[] = $datum;
            } elseif($datum->$serachBy() ===  $keys) {
                $searched[] = $datum;
            }

        }
        return $searched;
    }

}
