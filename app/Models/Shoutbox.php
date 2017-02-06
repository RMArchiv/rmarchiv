<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Shoutbox
 *
 * @property integer $id
 * @property string $shout_md
 * @property string $shout_html
 * @property integer $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereShoutMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereShoutHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shoutbox whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 */
class Shoutbox extends Model
{
    protected $table = 'shoutbox';

    public $timestamps = true;

    protected $fillable = [
        'shout_md',
        'shout_html',
        'user_id'
    ];

    protected $guarded = [];

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
        
}