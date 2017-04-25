<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Revision
 *
 * @property int $id
 * @property string $revisionable_type
 * @property int $revisionable_id
 * @property int $user_id
 * @property string $key
 * @property string $old_value
 * @property string $new_value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereNewValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereOldValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereRevisionableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereRevisionableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Revision whereUserId($value)
 * @mixin \Eloquent
 */
class Revision extends Model
{
    protected $table = 'revisions';

    public $timestamps = true;

    protected $fillable = [
        'revisionable_type',
        'revisionable_id',
        'user_id',
        'key',
        'old_value',
        'new_value'
    ];

    protected $guarded = [];

        
}