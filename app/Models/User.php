<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Cog\Laravel\Ban\Traits\Bannable;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

/*
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $is_admin
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\News[] $news
 * @property-read \App\Models\UserSetting $settings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Logo[] $logo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LogoVote[] $logovote
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserObyx[] $userobyx
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Message[] $messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Participant[] $participants
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Thread[] $threads
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserList[] $userlists
 */

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $is_admin
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Logo[] $logo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LogoVote[] $logovote
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Message[] $messages
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\News[] $news
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Participant[] $participants
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $roles
 * @property-read \App\Models\UserSetting $settings
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cmgmyr\Messenger\Models\Thread[] $threads
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserList[] $userlists
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserObyx[] $userobyx
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property string $discord_user
 * @property string $discord_channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardPost[] $boardposts
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDiscordChannel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDiscordUser($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Shoutbox[] $shoutbox
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Developer[] $developers
 * @property string|null $banned_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Cog\Laravel\Ban\Models\Ban[] $bans
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBannedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withRole($role)
 */
class User extends Authenticatable implements BannableContract
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    use Bannable;
    use CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin',
    ];

    use Notifiable;
    use EntrustUserTrait;
    use Messagable;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function games()
    {
        return $this->hasMany('App\Models\Game', 'user_id', 'id');
    }

    public function news()
    {
        return $this->belongsToMany('App\Models\News');
    }

    public function settings()
    {
        return $this->hasOne('App\Models\UserSetting', 'user_id', 'id');
    }

    public function logo()
    {
        return $this->hasMany('App\Models\Logo', 'user_id', 'id');
    }

    public function logovote()
    {
        return $this->belongsToMany('App\Models\LogoVote');
    }

    public function userobyx()
    {
        return $this->hasMany('App\Models\UserObyx', 'user_id', 'id');
    }

    public function userlists()
    {
        return $this->hasMany('App\Models\UserList', 'user_id', 'id');
    }

    public function boardposts()
    {
        return $this->hasMany('App\Models\BoardPost', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id', 'id');
    }

    public function shoutbox()
    {
        return $this->hasMany('App\Models\Shoutbox', 'user_id', 'id');
    }

    public function developers()
    {
        return $this->hasMany('App\Models\Developer', 'user_id', 'id');
    }
}
