<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class News.
 *
 * @property int $id
 * @property string $title
 * @property string $news_md
 * @property string $news_html
 * @property string $news_category
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property int $approved
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereApproved($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class News extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'news';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'news_md',
        'news_html',
        'news_category',
        'user_id',
        'approved',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'content_id', 'id')->Where('content_type', '=', \DB::raw("'news'"))->with('user');
    }
}
