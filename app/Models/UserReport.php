<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserReport.
 *
 * @property int $id
 * @property int $user_id
 * @property int $content_id
 * @property string $content_type
 * @property string $reason
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereContentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $closed
 * @property int $closed_user_id
 * @property string $closed_remarks
 * @property string $closed_at
 * @property-read \App\Models\Game $game
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $user_closed
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereClosed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereClosedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereClosedRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserReport whereClosedUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReport query()
 */
class UserReport extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'user_reports';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'content_id',
        'content_type',
        'reason',
        'closed_user_id',
        'closed',
        'closed_remarks',
        'closed_at',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function user_closed()
    {
        return $this->hasOne('App\Models\User', 'id', 'closed_user_id');
    }

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'content_id');
    }
}
