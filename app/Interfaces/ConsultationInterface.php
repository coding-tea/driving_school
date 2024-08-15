<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ConsultationInterface
{
    /***
     * Users datatable actions
     * @return array
     */
    public static function heads(): array;
    /***
     * Users datatable columns
     * @return  array
     */
    public static function actions(): array;
}
