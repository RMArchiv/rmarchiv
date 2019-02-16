<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ban.
 *
 * @property int $id
 * @property int $bannable_id
 * @property string $bannable_type
 * @property int|null $created_by_id
 * @property string|null $created_by_type
 * @property string|null $comment
 * @property string|null $expired_at
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereBannableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereBannableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereCreatedByType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ban query()
 */
class Ban extends Model
{
    protected $table = 'bans';

    public $timestamps = true;

    protected $fillable = [
        'bannable_id',
        'bannable_type',
        'created_by_id',
        'created_by_type',
        'comment',
        'expired_at',
    ];

    protected $guarded = [];
}
