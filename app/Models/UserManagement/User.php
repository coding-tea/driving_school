<?php

namespace App\Models\UserManagement;

use App\DTO\UserDto;
use App\Models\City;
use App\Models\Office;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasImage, HasRoles;

    const PK = 'id';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function isManager()
    {
        return $this->is_manager;
    }

    public function office(){
        return $this->hasOne(Office::class, 'id', 'office_id');
    }
}
