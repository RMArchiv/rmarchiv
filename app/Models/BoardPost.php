<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BoardPost query()
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

    public function reportUrl()
    {
        $position = DB::table('board_posts')
            ->where('thread_id', $this->thread_id)
            ->where('id', '<=', $this->id)
            ->count();
        $page = max(1, (int) ceil($position / 25));

        return route('board.thread.show', [$this->thread_id, 'page' => $page]).'#c'.$this->id;
    }

    public function reportExcerpt($limit = 160)
    {
        return Str::limit(strip_tags((string) $this->content_html), $limit);
    }
}
