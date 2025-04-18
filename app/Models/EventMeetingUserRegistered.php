<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventMeetingUserRegistered.
 *
 * @property int $id
 * @property int $event_id
 * @property int $meeting_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereMeetingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeetingUserRegistered whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeetingUserRegistered newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeetingUserRegistered newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventMeetingUserRegistered query()
 */
class EventMeetingUserRegistered extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'event_meeting_user_registered';

    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'meeting_id',
        'user_id',
    ];

    protected $guarded = [];

    public function event()
    {
        $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    public function meeting()
    {
        $this->hasOne('App\Models\EventMeeting', 'id', 'meeting_id');
    }

    public function user()
    {
        $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
