<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset.
 *
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereCreatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 */
class PasswordReset extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'password_resets';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'token',
    ];

    protected $guarded = [];
}
