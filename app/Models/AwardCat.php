<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AwardCat.
 *
 * @property int $id
 * @property string $title
 * @property int $award_page_id
 * @property int $year
 * @property int $month
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereAwardPageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereMonth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardCat whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\AwardPage $awardpage
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AwardSubcat[] $subcats
 */
class AwardCat extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;

    public $timestamps = true;
    protected $table = 'award_cats';
    protected $fillable = [
        'title',
        'award_page_id',
        'year',
        'month',
        'user_id',
    ];

    protected $guarded = [];

    public function awardpage()
    {
        return $this->hasOne('App\Models\AwardPage', 'id', 'award_page_id');
    }

    public function subcats()
    {
        return $this->hasMany('App\Models\AwardSubcat', 'cat_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
