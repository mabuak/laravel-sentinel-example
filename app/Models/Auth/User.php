<?php

namespace App\Models\Auth;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'permissions',
        'created_by',
        'updated_by'
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
}
