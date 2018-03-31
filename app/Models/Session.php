<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Session.
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string $payload
 * @property int $last_activity
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Session whereUserId($value)
 * @mixin \Eloquent
 */
class Session extends Model
{
    public $timestamps = false;
    protected $table = 'sessions';
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    protected $guarded = [];
}
