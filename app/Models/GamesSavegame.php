<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesSavegame
 *
 * @property int $id
 * @property int $user_id
 * @property int $gamefile_id
 * @property int $slot_id
 * @property mixed $save_data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereGamefileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereSaveData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereSlotId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesSavegame whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\GamesFile $gamefile
 */
class GamesSavegame extends Model
{
    public $timestamps = true;
    protected $table = 'games_savegames';
    protected $fillable = [
        'user_id',
        'gamefile_id',
        'slot_id',
        'save_data'
    ];

    protected $guarded = [];

    public function gamefile()
    {
        return $this->hasOne('App\Models\GamesFile', 'id', 'gamefile_id');
    }

        
}