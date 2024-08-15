<?php

namespace App\Interfaces;

interface DataTableInterface
{
    /***
     * Users datatable actions
     * @return array
     */
    public static function actions(): array;

    /***
     * Users datatable columns
     * @return  array
     */
    public static function heads(): array;


}
