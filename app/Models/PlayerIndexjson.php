<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayerIndexjson.
 *
 * @property int $id
 * @property int $gamefile_id
 * @property string $key
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereGamefileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereValue($value)
 * @mixin \Eloquent
 * @property string $filename
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerIndexjson whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerIndexjson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerIndexjson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerIndexjson query()
 */
class PlayerIndexjson extends Model
{
    protected $table = 'player_indexjson';

    public $timestamps = true;

    protected $fillable = [
        'gamefile_id',
        'key',
        'value',
    ];

    protected $guarded = [];
}
