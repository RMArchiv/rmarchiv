<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesFile
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $filesize
 * @property string $extension
 * @property integer $release_type
 * @property string $release_version
 * @property integer $release_year
 * @property integer $release_month
 * @property integer $release_day
 * @property integer $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
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
 * @property string $filename
 * @property integer $downloadcount
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFile whereDownloadcount($value)
 */
class GamesFile extends Model
{
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
        'user_id'
    ];

    protected $guarded = [];

        
}