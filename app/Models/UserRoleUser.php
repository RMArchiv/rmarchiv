<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRoleUser
 *
 * @property integer $user_id
 * @property integer $role_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRoleUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRoleUser whereRoleId($value)
 * @mixin \Eloquent
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