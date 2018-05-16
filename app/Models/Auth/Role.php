<?php

namespace App\Models\Auth;

use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole
{
    protected $fillable
        = [
            'slug',
            'name',
            'permissions',
            'created_at',
            'updated_at',
        ];
}
