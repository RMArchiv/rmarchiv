<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment.
 *
 * @property int $id
 * @property int $user_id
 * @property int $content_id
 * @property string $content_type
 * @property string $comment_md
 * @property string $comment_html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property int $vote_up
 * @property int $vote_down
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCommentHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereVoteUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment whereVoteDown($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $content
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Game $game
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\News $news
 */
class Comment extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    use SoftDeletes;

    public $timestamps = true;
    protected $table = 'comments';
    protected $fillable = [
        'user_id',
        'content_id',
        'content_type',
        'comment_md',
        'comment_html',
        'vote_up',
        'vote_down',
    ];

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function content()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'content_id')->with('user', 'maker', 'gamefiles', 'language');
    }

    public function news(){
        return $this->hasOne('App\Models\News', 'id', 'content_id');
    }
}
