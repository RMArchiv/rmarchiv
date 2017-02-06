<?php

namespace App\Models;

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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
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
 * @mixin \Eloquent
 *
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
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereYoutube($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TagRelation[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserCredit[] $credits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GamesAward[] $awards
 */
class Game extends Model
{
    use LogsActivity;

    protected $table = 'games';

    public $timestamps = true;

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
    ];

    protected static $logAttributes = [
        'title',
        'subtitle',
        'desc_md',
        'website_url',
        'user_id',
        'maker_id',
        'lang_id',
    ];

    protected $guarded = [];
    protected $appends = ['votes'];

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

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'content_id', 'id')->Where('content_type', '=', \DB::raw("'game'"))->with('user');
    }

    public function getVotesAttribute()
    {
        $vote['up'] = intval($this->comments()->sum('vote_up'));
        $vote['down'] = intval($this->comments()->sum('vote_down'));
        $vote['avg'] = @round(($vote['up'] - $vote['down']) / ($vote['up'] + $vote['down']), 2);
        //(voteup - votedown) / (voteup + votedown)
        return $vote;
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
}
