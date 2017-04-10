<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventUserRegistered.
 *
 * @property int $id
 * @property int $event_id
 * @property int $user_id
 * @property int $reg_price_payed
 * @property int $reg_state
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereRegPricePayed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereRegState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventUserRegistered whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\Event $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class EventUserRegistered extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'event_user_registered';

    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'user_id',
        'reg_price_payed',
        'reg_state',
    ];

    protected $guarded = [];

    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Event', 'id', 'user_id');
    }
}
