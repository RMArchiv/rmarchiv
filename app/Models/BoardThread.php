<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardThread
 *
 * @property integer $id
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $title
 * @property integer $closed
 * @property integer $pinned
 * @property integer $last_user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $last_created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereClosed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread wherePinned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereLastUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardThread whereLastCreatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\BoardCat $cat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BoardPost[] $posts
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $last_user
 */
class BoardThread extends Model
{
    protected $table = 'board_threads';

    public $timestamps = true;

    protected $fillable = [
        'cat_id',
        'user_id',
        'title',
        'closed',
        'pinned',
        'last_user_id',
        'last_created_at'
    ];

    protected $guarded = [];

    public function cat(){
        return $this->belongsTo('App\Models\BoardCat', 'cat_id', 'id');
    }

    public function posts(){
        return $this->hasMany('App\Models\BoardPost', 'thread_id', 'id');
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function last_user(){
        return $this->hasOne('App\Models\User', 'id', 'last_user_id');
    }
}