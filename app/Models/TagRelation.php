<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TagRelation.
 *
 * @property int $id
 * @property int $tag_id
 * @property int $user_id
 * @property int $content_id
 * @property string $content_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereTagId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TagRelation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Tag $tag
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Game[] $games
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TagRelation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TagRelation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TagRelation query()
 */
class TagRelation extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    public $timestamps = true;
    protected $table = 'tag_relations';
    protected $fillable = [
        'tag_id',
        'user_id',
        'content_id',
        'content_type',
    ];

    protected $guarded = [];

    public function tag()
    {
        return $this->hasOne('App\Models\Tag', 'id', 'tag_id');
    }

    public function games()
    {
        return $this->hasMany('App\Models\Game', 'id', 'content_id')->Where('content_type', '=', \DB::raw("'game'"));
    }
}
