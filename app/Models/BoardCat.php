<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardCat.
 *
 * @property int $id
 * @property int $order
 * @property string $title
 * @property string $desc
 * @property int $last_user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $last_created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereLastUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereLastCreatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardThread[] $threads
 * @property-read \App\Models\User $last_user
 */
class BoardCat extends Model
{
    protected $table = 'board_cats';

    public $timestamps = true;

    protected $fillable = [
        'order',
        'title',
        'desc',
        'last_user_id',
        'last_created_at',
    ];

    protected $guarded = [];

    public function threads()
    {
        return $this->hasMany('App\Models\BoardThread', 'cat_id', 'id');
    }

    public function last_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'last_user_id');
    }
}
