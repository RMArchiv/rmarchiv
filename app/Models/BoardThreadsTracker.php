<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardThreadsTracker.
 */
class BoardThreadsTracker extends Model
{
    protected $table = 'board_threads_tracker';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'thread_id',
        'last_read',
    ];

    protected $guarded = [];
}
