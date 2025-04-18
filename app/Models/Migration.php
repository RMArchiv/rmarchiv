<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Migration.
 *
 * @property int $id
 * @property string $migration
 * @property int $batch
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Migration whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Migration whereMigration($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Migration whereBatch($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Migration query()
 */
class Migration extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'migrations';

    public $timestamps = false;

    protected $fillable = [
        'migration',
        'batch',
    ];

    protected $guarded = [];
}
