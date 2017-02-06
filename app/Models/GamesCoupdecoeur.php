<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesCoupdecoeur
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\User $user
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

    public function game() {
        return $this->hasOne('App\Models\Game', 'id', 'game_id')->with('maker', 'developers', 'gamefiles');
    }

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
        
}