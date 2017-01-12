<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @property int $id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $table = 'tags';

    public $timestamps = true;

    protected $fillable = [
        'title'
    ];

    protected $guarded = [];

        
}