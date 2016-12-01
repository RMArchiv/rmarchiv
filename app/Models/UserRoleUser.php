<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRoleUser
 */
class UserRoleUser extends Model
{
    protected $table = 'user_role_user';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    protected $guarded = [];

        
}