<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resource.
 *
 * @property int $id
 * @property string $type
 * @property string $cat
 * @property int $user_id
 * @property string $title
 * @property string $desc_md
 * @property string $desc_html
 * @property string $content_type
 * @property string $content_path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereCat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereContentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereContentPath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Resource whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Resource extends Model
{
    protected $table = 'resources';

    public $timestamps = true;

    protected $fillable = [
        'type',
        'cat',
        'user_id',
        'title',
        'desc_md',
        'desc_html',
        'content_type',
        'content_path',
    ];

    protected $guarded = [];
}
