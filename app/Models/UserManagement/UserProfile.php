<?php

namespace App\Models\UserManagement;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserProfile extends Model
{
    protected $table = "profils_users";

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}


