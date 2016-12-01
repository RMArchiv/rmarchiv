<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardPost
 */
class BoardPost extends Model
{
    protected $table = 'board_posts';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'cat_id',
        'thread_id',
        'content_md',
        'content_html'
    ];

    protected $guarded = [];

        
}