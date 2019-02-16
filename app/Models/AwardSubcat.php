<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AwardSubcat.
 *
 * @property int $id
 * @property string $title
 * @property string $desc_html
 * @property string $desc_md
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $page_id
 * @property int $cat_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat wherePageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereCatId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesAward[] $game_awards
 * @property-read \App\Models\AwardCat $award_cat
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardSubcat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardSubcat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AwardSubcat query()
 */
class AwardSubcat extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    public $timestamps = true;
    protected $table = 'award_subcats';
    protected $fillable = [
        'title',
        'desc_html',
        'desc_md',
        'page_id',
        'cat_id',
    ];

    protected $guarded = [];

    public function game_awards()
    {
        return $this->hasMany('App\Models\GamesAward', 'award_subcat_id', 'id')->orderBy('place');
    }

    public function award_cat()
    {
        return $this->hasOne('App\Models\AwardCat', 'id', 'cat_id');
    }
}
