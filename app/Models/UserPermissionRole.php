<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPermissionRole
 */
class UserPermissionRole extends Model
{
    protected $table = 'user_permission_role';

    public $timestamps = false;

    protected $fillable = [
        'permission_id',
        'role_id'
    ];

    protected $guarded = [];

        
}