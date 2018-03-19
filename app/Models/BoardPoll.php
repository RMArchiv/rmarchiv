<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardPoll.
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $thread_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardPollAnswer[] $answers
 * @property-read \App\Models\BoardThread $thread
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPoll whereUserId($value)
 * @mixin \Eloquent
 */
class BoardPoll extends Model
{
    protected $table = 'board_poll';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'thread_id',
        'user_id',
    ];

    protected $guarded = [];

    public function answers()
    {
        return $this->hasMany('App\Models\BoardPollAnswer', 'id', 'poll_id');
    }

    public function thread()
    {
        return $this->hasOne('App\Models\BoardThread', 'id', 'thread_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
