<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Shoutbox.
 *
 * @property int $id
 * @property string $shout_md
 * @property string $shout_html
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereShoutMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereShoutHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class Shoutbox extends Model
{
    use Notifiable;
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'shoutbox';

    public $timestamps = true;

    protected $fillable = [
        'shout_md',
        'shout_html',
        'user_id',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function routeNotificationForDiscord()
    {
        return $this->shout_md;
    }
}
