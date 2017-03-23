<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MessengerMessage.
 *
 * @property int $id
 * @property int $thread_id
 * @property int $user_id
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MessengerMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MessengerMessage extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'messenger_messages';

    public $timestamps = true;

    protected $fillable = [
        'thread_id',
        'user_id',
        'body',
    ];

    protected $guarded = [];
}
