<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 *
 * @property int $id
 * @property int $user_id
 * @property string $start_date
 * @property string $end_date
 * @property string $title
 * @property string $description
 * @property int $slots
 * @property string $reg_start_date
 * @property string $reg_end_date
 * @property int $reg_allowed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereSlots($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereRegAllowed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    protected $table = 'events';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'title',
        'description',
        'slots',
        'reg_start_date',
        'reg_end_date',
        'reg_allowed'
    ];

    protected $guarded = [];

        
}