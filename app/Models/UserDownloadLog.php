<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserDownloadLog.
 *
 * @property int $id
 * @property int $user_id
 * @property int $gamefile_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereGamefileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserDownloadLog whereUserId($value)
 * @mixin \Eloquent
 */
class UserDownloadLog extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'user_download_log';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'gamefile_id',
    ];

    protected $guarded = [];
}
