<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\AdminRole;
use App\Enums\Status;
use App\Helpers\ConnectedAdmin;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class City extends Authenticatable
{
    use HasFactory, Notifiable;


    public const  PK = 'id';



    public  function region(){
        return $this->hasOne(Region::class , 'region' , 'id');
    }


}
