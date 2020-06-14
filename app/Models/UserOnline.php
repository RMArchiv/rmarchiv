<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserOnline.
 *
 * @property int $id
 * @property int $user_id
 * @property string $last_place
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereLastPlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserOnline whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOnline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOnline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserOnline query()
 */
class UserOnline extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $table = 'user_online';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'last_place',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
