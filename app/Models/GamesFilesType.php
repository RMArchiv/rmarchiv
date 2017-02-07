<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesFilesType.
 *
 * @property int $id
 * @property string $title
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $short
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesFilesType whereShort($value)
 * @mixin \Eloquent
 */
class GamesFilesType extends Model
{
    protected $table = 'games_files_types';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'short',
    ];

    protected $guarded = [];
}
