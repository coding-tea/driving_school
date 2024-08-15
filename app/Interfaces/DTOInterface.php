<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


interface DTOInterface
{
    public static  function fromJson($data);
    public static  function fromRequest(Request  $request);
    public static  function fromModel( Model $model);

}
