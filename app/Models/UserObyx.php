<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserObyx.
 *
 * @property int $id
 * @property int $user_id
 * @property int $obyx_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereObyxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Obyx $obyx
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class UserObyx extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'user_obyx';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'obyx_id',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function obyx()
    {
        return $this->hasOne('App\Models\Obyx', 'id', 'obyx_id');
    }
}
