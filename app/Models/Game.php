<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Game.
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property string $desc_md
 * @property string $desc_html
 * @property string $website_url
 * @property int $user_id
 * @property int $views
 * @property string $release_date
 * @property int $maker_id
 * @property int $lang_id
 * @property string $deleted_at
 * @property int $atelier_id
 * @property string $makerpendium_article
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereViews($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereReleaseDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereMakerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereLangId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereMakerpeniumArticle($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Maker $maker
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesDeveloper[] $developer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Developer[] $developers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Screenshot[] $screenshots
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read mixed $votes
 * @property-read \App\Models\Language $language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesFile[] $gamefiles
 * @property string $youtube
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereYoutube($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TagRelation[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserCredit[] $credits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesAward[] $awards
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesCoupdecoeur[] $cdcs
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereAtelierId($value)
 * @property int $release_type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereReleaseType($value)
 * @property int $voteup
 * @property int $votedown
 * @property string $avg
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereAvg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereVotedown($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereVoteup($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property string $desc_md_translation
 * @property int $license_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereDescMdTranslation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereLicenseId($value)
 * @property-read \App\Models\License $license
 * @property int $is_banned
 * @property string $is_banned_reason
 * @property string $is_banned_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereIsBanned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereIsBannedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Game whereIsBannedReason($value)
 */
class Game extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    //use Translatable;
    use LogsActivity;
    use Searchable;

    protected static $logAttributes = [
        'title',
        'subtitle',
        'desc_md',
        'website_url',
        'user_id',
        'maker_id',
        'lang_id',
        'atelier_id',
        'makerpendium_article',
    ];
    public $timestamps = true;
    protected $table = 'games';
    protected $fillable = [
        'title',
        'subtitle',
        'desc_md',
        'desc_html',
        'website_url',
        'user_id',
        'views',
        'release_date',
        'maker_id',
        'lang_id',
        'atelier_id',
        'release_type',
        'voteup',
        'votedown',
        'avg',
        'comments',
        'license_id',
        'makerpendium_article',
    ];
    protected $hidden = [
        'votes',
    ];

    protected $guarded = [];
    protected $appends = ['votes'];
    //protected $translatableAttributes = ['desc_md'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function maker()
    {
        return $this->hasOne('App\Models\Maker', 'id', 'maker_id');
    }

    public function developers()
    {
        return $this->hasMany('App\Models\GamesDeveloper', 'game_id', 'id');
    }

    public function screenshots()
    {
        return $this->hasMany('App\Models\Screenshot');
    }

    public function getVotesAttribute()
    {
        $vote['up'] = intval($this->comments()->sum('vote_up'));
        $vote['down'] = intval($this->comments()->sum('vote_down'));
        $sum = $vote['up'] + $vote['down'];
        if($sum >= 1){
            $vote['avg'] = @round(($vote['up'] - $vote['down']) / ($vote['up'] + $vote['down']), 2);
        }else{
            $vote['avg'] = 0;
        }
        //(voteup - votedown) / (voteup + votedown)
        return $vote;
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'content_id', 'id')->Where('content_type', '=', \DB::raw("'game'"))->with('user');
    }

    public function language()
    {
        return $this->hasOne('App\Models\Language', 'id', 'lang_id');
    }

    public function gamefiles()
    {
        return $this->hasMany('App\Models\GamesFile', 'game_id', 'id')
            ->orderBy('release_type', 'desc')
            ->orderBy('release_year', 'desc')
            ->orderBy('release_month', 'desc')
            ->orderBy('release_day', 'desc')
            ->with('gamefiletype')
            ->withTrashed();
    }

    public function tagCount()
    {
        return $this->tags()
            ->selectRaw('id, count(*) as tagcount')
            ->groupBy('id');
    }

    public function tags()
    {
        return $this->hasMany('App\Models\TagRelation', 'content_id', 'id')->Where('content_type', '=', \DB::raw("'game'"))->with('tag');
    }

    public function credits()
    {
        return $this->hasMany('App\Models\UserCredit', 'game_id', 'id');
    }

    public function awards()
    {
        return $this->hasMany('App\Models\GamesAward', 'game_id', 'id')->Where('place', '<=', 3);
    }

    public function cdcs()
    {
        return $this->hasMany('App\Models\GamesCoupdecoeur', 'game_id', 'id');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id'       => $this->id,
            'title'    => $this->title,
            'subtitle' => $this->subtitle,
        ];
    }

    public function license()
    {
        return $this->hasOne('App\Models\License', 'id', 'license_id');
    }
}
