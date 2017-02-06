<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserPermissionRole.
 *
 * @property int $permission_id
 * @property int $role_id
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermissionRole wherePermissionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserPermissionRole whereRoleId($value)
 * @mixin \Eloquent
 */
class UserPermissionRole extends Model
{
    protected $table = 'user_permission_role';

    public $timestamps = false;

    protected $fillable = [
        'permission_id',
        'role_id',
    ];

    protected $guarded = [];
}
