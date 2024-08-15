<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'profils';
    public $timestamps = false;
    protected $guarded = [];
 
    public function image()
    {
        return  $this->HasOne(Image::class, 'id', "image_id");
    }

    public function cinid()
    {
        return  $this->HasOne(Image::class, 'id', "cinimage");
    }

}
