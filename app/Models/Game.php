<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Game
 *
 * @property integer $id
 * @property string $title
 * @property string $subtitle
 * @property string $desc_md
 * @property string $desc_html
 * @property string $website_url
 * @property integer $user_id
 * @property integer $views
 * @property string $release_date
 * @property integer $maker_id
 * @property string $deleted_at
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Game whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Maker $maker
 */
class Game extends Model
{
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
        'maker_id'
    ];

    protected $guarded = [];

    public function user(){
        return $this->hasOne('App\Models\User');
    }

    public function maker(){
        return $this->hasOne('App\Models\Maker');
    }
}