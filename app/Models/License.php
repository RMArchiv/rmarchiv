<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class License.
 *
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\License query()
 */
class License extends Model
{
    public $timestamps = true;
    protected $table = 'licenses';
    protected $fillable = [
        'title',
        'icon',
    ];

    protected $guarded = [];
}
