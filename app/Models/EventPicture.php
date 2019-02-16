<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventPicture.
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
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Event $event
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventPicture query()
 */
class EventPicture extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'event_pictures';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'event_id',
        'title',
        'desc',
        'filename',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }
}
