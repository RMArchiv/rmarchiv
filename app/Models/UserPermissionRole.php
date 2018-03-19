<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

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
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class UserPermissionRole extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'user_permission_role';

    public $timestamps = false;

    protected $fillable = [
        'permission_id',
        'role_id',
    ];

    protected $guarded = [];
}
