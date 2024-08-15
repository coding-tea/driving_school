<?php

namespace App\Models;


use App\Models\GeoJson\FeatureCollection;
use App\Traits\GeoJson\Geo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Region extends Authenticatable
{
    use Geo;

    protected $table = 'regions';
    protected $primaryKey = 'id';
    public $timestamps = true;


    public  function  cities()
    {
        return $this->hasMany(City::class, 'id', 'region');
    }

}
