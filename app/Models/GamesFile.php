<?php

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
 */
class GamesFile extends Model
{
    use SoftDeletes;

    protected $table = 'games_files';

    public $timestamps = true;

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
        return $this->belongsTo('App\Models\Game', 'game_id', 'id')->with('maker', 'developers');
    }
}
