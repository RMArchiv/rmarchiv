<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class GamesFile.
 *
 * @property int $id
 * @property int $game_id
 * @property int $filesize
 * @property string $extension
 * @property int $release_type
 * @property string $release_version
 * @property int $release_year
 * @property int $release_month
 * @property int $release_day
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereFilesize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseVersion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReleaseDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property string $filename
 * @property int $downloadcount
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereDownloadcount($value)
 *
 * @property-read \App\Models\GamesFilesType $gamefiletype
 * @property-read \App\Models\Game $game
 * @property int $forbidden
 * @property string $reason
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereForbidden($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereReason($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlayerIndexjson[] $playerIndex
 * @property-read \App\Models\User $user
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile withoutTrashed()
 */
class GamesFile extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'games_files';
    protected $fillable = [
        'game_id',
        'filesize',
        'extension',
        'release_type',
        'release_version',
        'release_year',
        'release_month',
        'release_day',
        'user_id',
    ];

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function gamefiletype()
    {
        return $this->hasOne('App\Models\GamesFilesType', 'id', 'release_type');
    }

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id');
    }

    public function playerIndex()
    {
        return $this->hasMany('App\Models\PlayerIndexjson', 'gamefile_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
