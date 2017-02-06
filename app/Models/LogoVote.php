<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LogoVote
 *
 * @property integer $id
 * @property integer $logo_id
 * @property integer $user_id
 * @property integer $up
 * @property integer $down
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Logo $logo
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereLogoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereDown($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\LogoVote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LogoVote extends Model
{
    protected $table = 'logo_votes';

    public $timestamps = true;

    protected $fillable = [
        'logo_id',
        'user_id',
        'up',
        'down'
    ];

    protected $guarded = [];

    public function user() {
        return $this->hasOne('App\Models\User');
    }

    public function logo() {
        return $this->hasOne('App\Models\Logo');
    }
}