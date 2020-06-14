<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardThreadsTracker.
 *
 * @property int $id
 * @property int $user_id
 * @property int $thread_id
 * @property string $last_read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereLastRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThreadsTracker whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThreadsTracker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThreadsTracker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardThreadsTracker query()
 */
class BoardThreadsTracker extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'board_threads_tracker';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'thread_id',
        'last_read',
    ];

    protected $guarded = [];
}
