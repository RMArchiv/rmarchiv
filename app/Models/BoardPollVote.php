<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardPollVote.
 *
 * @property int $id
 * @property int $poll_id
 * @property int $answer_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereAnswerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote wherePollId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollVote whereUserId($value)
 * @mixin \Eloquent
 */
class BoardPollVote extends Model
{
    protected $table = 'board_poll_votes';

    public $timestamps = true;

    protected $fillable = [
        'poll_id',
        'answer_id',
        'user_id',
    ];

    protected $guarded = [];
}
