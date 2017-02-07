<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSetting.
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_admin
 * @property int $is_moderator
 * @property string $avatar_path
 * @property int $is_banned
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsModerator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereAvatarPath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\User $user
 */
class UserSetting extends Model
{
    protected $table = 'user_settings';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'is_admin',
        'is_moderator',
        'avatar_path',
        'is_banned',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }
}
