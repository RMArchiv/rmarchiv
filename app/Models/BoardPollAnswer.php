<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardPollAnswer.
 *
 * @property int $id
 * @property int $poll_id
 * @property string $title
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\BoardPoll $poll
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardPollVote[] $votes
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer wherePollId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPollAnswer whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPollAnswer query()
 */
class BoardPollAnswer extends Model
{
    protected $table = 'board_poll_answers';

    public $timestamps = true;

    protected $fillable = [
        'poll_id',
        'title',
        'user_id',
    ];

    protected $guarded = [];

    public function poll()
    {
        return $this->hasOne('App\Models\BoardPoll', 'poll_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany('App\Models\BoardPollVote', 'answer_id', 'id');
    }
}
