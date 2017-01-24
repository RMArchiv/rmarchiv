<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserCredit
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $credit_type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereCreditTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserCredit whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserCredit extends Model
{
    protected $table = 'user_credits';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'game_id',
        'credit_type_id'
    ];

    protected $guarded = [];

    public function type(){
        return $this->hasOne('App\Models\UserCreditType', 'id', 'credit_type_id');
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}