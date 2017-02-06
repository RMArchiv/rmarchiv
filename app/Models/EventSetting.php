<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventSetting.
 *
 * @property int $id
 * @property int $event_id
 * @property int $slots
 * @property string $reg_start_date
 * @property string $reg_end_date
 * @property int $reg_allowed
 * @property int $reg_price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereSlots($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereRegStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereRegEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereRegAllowed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereRegPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\Event $event
 */
class EventSetting extends Model
{
    protected $table = 'event_settings';

    public $timestamps = true;

    protected $fillable = [
        'event_id',
        'slots',
        'reg_start_date',
        'reg_end_date',
        'reg_allowed',
        'reg_price',
    ];

    protected $guarded = [];

    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }
}
