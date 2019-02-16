<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Obyx.
 *
 * @property int $id
 * @property int $value
 * @property string $reason
 * @property string $reason_visible
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereReasonVisible($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Obyx whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Obyx newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Obyx newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Obyx query()
 */
class Obyx extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'obyx';

    public $timestamps = true;

    protected $fillable = [
        'value',
        'reason',
        'reason_visible',
    ];

    protected $guarded = [];
}
