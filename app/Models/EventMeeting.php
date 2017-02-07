<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventMeeting.
 *
 * @property int $id
 * @property int $event_id
 * @property int $reg_type
 * @property int $slots
 * @property string $start_date
 * @property string $end_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereRegType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereSlots($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventMeeting whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\Event $event
 */
class EventMeeting extends Model
{
    protected $table = 'event_meetings';

    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'reg_type',
        'slots',
        'start_date',
        'end_date',
    ];

    protected $guarded = [];

    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }
}
