<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRoleUser.
 *
 * @property int $user_id
 * @property int $role_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRoleUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRoleUser whereRoleId($value)
 * @mixin \Eloquent
 */
class UserRoleUser extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'user_role_user';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    protected $guarded = [];
}
