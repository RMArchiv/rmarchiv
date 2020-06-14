<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Screenshot.
 *
 * @property int $id
 * @property int $game_id
 * @property int $user_id
 * @property int $screenshot_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $filename
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereScreenshotId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screenshot whereFilename($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Screenshot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Screenshot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Screenshot query()
 */
class Screenshot extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'screenshots';

    public $timestamps = true;

    protected $fillable = [
        'game_id',
        'user_id',
        'screenshot_id',
        'filename',
    ];

    protected $guarded = [];
}
