<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MessengerParticipant.
 *
 * @property int $id
 * @property int $thread_id
 * @property int $user_id
 * @property string $last_read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereLastRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerParticipant whereDeletedAt($value)
 * @mixin \Eloquent
 */
class MessengerParticipant extends Model
{
    protected $table = 'messenger_participants';

    public $timestamps = true;

    protected $fillable = [
        'thread_id',
        'user_id',
        'last_read',
    ];

    protected $guarded = [];
}
