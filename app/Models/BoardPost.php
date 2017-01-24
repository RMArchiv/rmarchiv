<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardPost
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $cat_id
 * @property integer $thread_id
 * @property string $content_md
 * @property string $content_html
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereContentMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereContentHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardPost whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\BoardCat $cat
 * @property-read \App\Models\BoardThread $thread
 * @property-read \App\Models\User $user
 */
class BoardPost extends Model
{
    protected $table = 'board_posts';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'cat_id',
        'thread_id',
        'content_md',
        'content_html'
    ];

    protected $guarded = [];

    public function cat(){
        return $this->belongsTo('App\Models\BoardCat', 'cat_id', 'id');
    }

    public function thread(){
        return $this->belongsTo('App\Models\BoardThread', 'thread_id', 'id');
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}