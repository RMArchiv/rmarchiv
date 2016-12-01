<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Screenshot
 */
class Screenshot extends Model
{
    protected $table = 'screenshots';

    public $timestamps = true;

    protected $fillable = [
        'game_id',
        'user_id',
        'screenshot_id',
        'filename'
    ];

    protected $guarded = [];

        
}