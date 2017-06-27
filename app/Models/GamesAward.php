<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesAward.
 *
 * @property int $id
 * @property int $game_id
 * @property int $developer_id
 * @property int $award_cat_id
 * @property int $award_page_id
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $place
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereDeveloperId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereAwardCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereAwardPageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward wherePlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereDescription($value)
 * @mixin \Eloquent
 * @property int $award_subcat_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereAwardSubcatId($value)
 * @property-read \App\Models\User $user
 * @property-read \App\Models\AwardCat $cat
 * @property-read \App\Models\AwardPage $page
 * @property-read \App\Models\AwardSubcat $subcat
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \App\Models\Game $game
 */
class GamesAward extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    public $timestamps = true;
    protected $table = 'games_awards';
    protected $fillable = [
        'game_id',
        'developer_id',
        'award_cat_id',
        'award_page_id',
        'user_id',
        'place',
        'description',
        'award_subcat_id',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function cat()
    {
        return $this->hasOne('App\Models\AwardCat', 'id', 'award_cat_id');
    }

    public function page()
    {
        return $this->hasOne('App\Models\AwardPage', 'id', 'award_page_id');
    }

    public function subcat()
    {
        return $this->hasOne('App\Models\AwardSubcat', 'id', 'award_subcat_id');
    }

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id');
    }
}
