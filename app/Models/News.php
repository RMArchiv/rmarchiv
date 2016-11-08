<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 *
 * @property integer $id
 * @property string $title
 * @property string $news_md
 * @property string $news_html
 * @property string $news_category
 * @property integer $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereNewsCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\News whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
class News extends Model
{
    protected $table = 'news';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'news_md',
        'news_html',
        'news_category',
        'user_id'
    ];

    protected $guarded = [];

    public function user(){
        return $this->hasOne('App\Models\User');
    }
}