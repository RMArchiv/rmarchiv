<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivityLog.
 *
 * @property int $id
 * @property string $log_name
 * @property string $description
 * @property int $subject_id
 * @property string $subject_type
 * @property int $causer_id
 * @property string $causer_type
 * @property string $properties
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereCauserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereCauserType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereLogName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereProperties($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereSubjectId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereSubjectType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActivityLog whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActivityLog query()
 */
class ActivityLog extends Model
{
    protected $table = 'activity_log';

    public $timestamps = true;

    protected $fillable = [
        'log_name',
        'description',
        'subject_id',
        'subject_type',
        'causer_id',
        'causer_type',
        'properties',
    ];

    protected $guarded = [];
}
