<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Model;

class DTO
{
    /***
     * @return array
     */
    public function toArray(): array
    {
        return array_filter(get_object_vars($this));
    }

}
