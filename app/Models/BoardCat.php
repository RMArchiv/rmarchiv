<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardCat
 */
class BoardCat extends Model
{
    protected $table = 'board_cats';

    public $timestamps = true;

    protected $fillable = [
        'order',
        'title',
        'desc',
        'last_user_id',
        'last_created_at'
    ];

    protected $guarded = [];

        
}