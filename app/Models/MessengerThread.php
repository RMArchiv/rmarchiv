<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MessengerThread.
 *
 * @property int $id
 * @property string $subject
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereSubject($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerThread whereDeletedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MessengerParticipant[] $participants
 */
class MessengerThread extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    public $timestamps = true;
    protected $table = 'messenger_threads';
    protected $fillable = [
        'subject',
    ];

    protected $guarded = [];

    public function participants()
    {
        return $this->hasMany('App\Models\MessengerParticipant', 'thread_id', 'id');
    }
}
