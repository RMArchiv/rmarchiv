<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardThread
 */
class BoardThread extends Model
{
    protected $table = 'board_threads';

    public $timestamps = true;

    protected $fillable = [
        'cat_id',
        'user_id',
        'title',
        'closed',
        'pinned',
        'last_user_id',
        'last_created_at'
    ];

    protected $guarded = [];

        
}