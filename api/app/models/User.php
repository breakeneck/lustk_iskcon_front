<?php

namespace App\Models;

use Leaf\Model;

/**
 * @property $id
 * @property $name
 * @property $email
 * @property $password
 * @property $access_token
 * @property $create_time
 * @property $update_time
 */
class User extends Model
{
//    const CREATED_AT = 'create_time';
//    const UPDATED_AT = 'update_time';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    protected $table = 'user';
}
