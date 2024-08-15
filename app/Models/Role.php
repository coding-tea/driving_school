<?php

namespace App\Models;

use App\Enums\YesNo;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as baseRole;

class Role extends baseRole
{

    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = true;
//
//    protected $casts = [
//        'is_for_manager' => YesNo::class
//    ];

    /**
     * Get the user's first name.
     */

     // protected function isForManager(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => YesNo::tryFrom($value)->text(),
    //     );
    // }

}
