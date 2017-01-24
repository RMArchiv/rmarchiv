<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesDeveloper
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $game_id
 * @property integer $developer_id
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
 */
class GamesDeveloper extends Model
{
    protected $table = 'games_developer';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'game_id',
        'developer_id'
    ];

    protected $guarded = [];

    public function developer(){
        return $this->hasOne('App\Models\Developer', 'id', 'developer_id');
    }
        
}