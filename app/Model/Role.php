<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    //
    protected $fillable = [
        "name",
        "guard_name",
    ];

}
