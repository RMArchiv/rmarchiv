<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventPicture
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property string $title
 * @property string $desc
 * @property string $filename
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventPicture whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EventPicture extends Model
{
    protected $table = 'event_pictures';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'event_id',
        'title',
        'desc',
        'filename'
    ];

    protected $guarded = [];

        
}