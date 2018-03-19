<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventAdmin.
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventAdmin whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class EventAdmin extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'event_admins';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'event_id',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id', 'user_id');
    }
}
