<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Resource.
 *
 * @property int $id
 * @property string $type
 * @property string $cat
 * @property int $user_id
 * @property string $title
 * @property string $desc_md
 * @property string $desc_html
 * @property string $content_type
 * @property string $content_path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereCat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereContentPath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read mixed $votes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TagRelation[] $tags
 * @property-read \App\Models\User $user
 */
class Resource extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    use LogsActivity;

    protected $table = 'resources';

    public $timestamps = true;

    protected $fillable = [
        'type',
        'cat',
        'user_id',
        'title',
        'desc_md',
        'desc_html',
        'content_type',
        'content_path',
    ];

    protected $hidden = [
        'votes',
    ];

    protected $guarded = [];
    protected $appends = ['votes'];

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getVotesAttribute()
    {
        $vote['up'] = intval($this->comments()->sum('vote_up'));
        $vote['down'] = intval($this->comments()->sum('vote_down'));
        $vote['avg'] = @round(($vote['up'] - $vote['down']) / ($vote['up'] + $vote['down']), 2);
        //(voteup - votedown) / (voteup + votedown)
        return $vote;
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'content_id', 'id')->Where('content_type', '=', \DB::raw("'resource'"))->with('user');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\TagRelation', 'content_id', 'id')->Where('content_type', '=', \DB::raw("'resource'"))->with('tag');
    }
}
