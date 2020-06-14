<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language.
 *
 * @property int $id
 * @property string $name
 * @property string $short
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Language whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 */
class Language extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'languages';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'short',
    ];

    protected $guarded = [];
}
