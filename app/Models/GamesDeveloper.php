<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class GamesDeveloper.
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $developer_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereDeveloperId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesDeveloper whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Developer $developer
 * @property-read \App\Models\Game $game
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activity
 */
class GamesDeveloper extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    use LogsActivity;

    protected $table = 'games_developer';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'game_id',
        'developer_id',
    ];

    protected $guarded = [];

    public function developer()
    {
        return $this->hasOne('App\Models\Developer', 'id', 'developer_id')->with('user');
    }

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id')->with('comments', 'maker', 'gamefiles', 'cdcs');
    }
}
