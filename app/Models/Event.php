<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 *
 * @property int $id
 * @property int $user_id
 * @property string $start_date
 * @property string $end_date
 * @property string $title
 * @property string $description
 * @property int $slots
 * @property string $reg_start_date
 * @property string $reg_end_date
 * @property int $reg_allowed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereSlots($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegAllowed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventSetting[] $settings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventMeeting[] $meetings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventUserRegistered[] $users_registered
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventPicture[] $pictures
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 */
class Event extends Model
{
    protected $table = 'events';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'title',
        'description',
        'slots',
        'reg_start_date',
        'reg_end_date',
        'reg_allowed'
    ];

    protected $guarded = [];

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function settings(){
        return $this->hasOne('App\Models\EventSetting', 'event_id', 'id');
    }

    public function meetings(){
        return $this->hasMany('App\Models\EventMeeting', 'event_id', 'id');
    }

    public function users_registered(){
        return $this->hasMany('App\Models\EventUserRegistered', 'event_id', 'id');
    }

    public function pictures(){
        return $this->hasMany('App\Models\EventPicture', 'event_id', 'id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment', 'content_id', 'id')->Where('content_type', '=', \DB::raw("'game'"))->with('user');
    }
}