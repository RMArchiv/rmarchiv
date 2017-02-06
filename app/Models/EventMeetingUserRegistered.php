<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventMeetingUserRegistered
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
 */
class EventMeetingUserRegistered extends Model
{
    protected $table = 'event_meeting_user_registered';

    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'meeting_id',
        'user_id'
    ];

    protected $guarded = [];

    public function event() {
        $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    public function meeting() {
        $this->hasOne('App\Models\EventMeeting', 'id', 'meeting_id');
    }

    public function user() {
        $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}