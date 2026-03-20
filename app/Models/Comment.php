<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Comment withoutTrashed()
 * @property int $deleted
 * @property string $delete_reason
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereDeleteReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
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
        'deleted',
        'delete_reason',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

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

    public function news()
    {
        return $this->hasOne('App\Models\News', 'id', 'content_id');
    }

    public function resource()
    {
        return $this->hasOne('App\Models\Resource', 'id', 'content_id');
    }

    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id', 'content_id');
    }

    public function reportContextLabel()
    {
        return match ($this->content_type) {
            'game' => optional($this->game)->title ?: 'Spiel #'.$this->content_id,
            'news' => optional($this->news)->title ?: 'News #'.$this->content_id,
            'resource' => optional($this->resource)->title ?: 'Ressource #'.$this->content_id,
            'event' => optional($this->event)->title ?: 'Event #'.$this->content_id,
            default => 'Kommentar #'.$this->id,
        };
    }

    public function reportUrl()
    {
        return match ($this->content_type) {
            'game' => action('GameController@show', $this->content_id).'#c'.$this->id,
            'news' => action('NewsController@show', $this->content_id).'#c'.$this->id,
            'resource' => optional($this->resource)
                ? route('resources.show', [$this->resource->type, $this->resource->cat, $this->resource->id]).'#c'.$this->id
                : null,
            'event' => route('events.show', $this->content_id).'#c'.$this->id,
            default => null,
        };
    }

    public function reportExcerpt($limit = 160)
    {
        return Str::limit(strip_tags((string) $this->comment_html), $limit);
    }
}
