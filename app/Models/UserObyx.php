<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserObyx
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $obyx_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereObyxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserObyx whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserObyx extends Model
{
    protected $table = 'user_obyx';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'obyx_id'
    ];

    protected $guarded = [];

        
}