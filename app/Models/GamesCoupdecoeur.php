<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesCoupdecoeur.
 *
 * @property int $id
 * @property int $game_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesCoupdecoeur whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class GamesCoupdecoeur extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'games_coupdecoeur';

    public $timestamps = true;

    protected $fillable = [
        'game_id',
        'user_id',
    ];

    protected $guarded = [];

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id')->with('maker', 'developers', 'gamefiles');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
