<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserList.
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $desc_html
 * @property string $desc_md
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserList whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserListItem[] $listitems
 * @property-read \App\Models\User $user
 */
class UserList extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    public $timestamps = true;
    protected $table = 'user_lists';
    protected $fillable = [
        'user_id',
        'title',
        'desc_html',
        'desc_md',
    ];

    protected $guarded = [];

    public function listitems()
    {
        return $this->hasMany('App\Models\UserListItem', 'list_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
