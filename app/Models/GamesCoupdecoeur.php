<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesCoupdecoeur
 */
class GamesCoupdecoeur extends Model
{
    protected $table = 'games_coupdecoeur';

    public $timestamps = true;

    protected $fillable = [
        'game_id',
        'user_id'
    ];

    protected $guarded = [];

        
}