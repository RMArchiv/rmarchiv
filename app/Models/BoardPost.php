<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardPost.
 *
 * @property int $id
 * @property int $user_id
 * @property int $cat_id
 * @property int $thread_id
 * @property string $content_md
 * @property string $content_html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereContentMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereContentHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\BoardCat $cat
 * @property-read \App\Models\BoardThread $thread
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class BoardPost extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    public $timestamps = true;
    protected $table = 'board_posts';
    protected $fillable = [
        'user_id',
        'cat_id',
        'thread_id',
        'content_md',
        'content_html',
    ];

    protected $guarded = [];

    public function cat()
    {
        return $this->hasOne('App\Models\BoardCat', 'id', 'cat_id');
    }

    public function thread()
    {
        return $this->hasOne('App\Models\BoardThread', 'id', 'thread_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
