<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserReport
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
 */
class UserReport extends Model
{
    protected $table = 'user_reports';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'content_id',
        'content_type',
        'reason'
    ];

    protected $guarded = [];

        
}