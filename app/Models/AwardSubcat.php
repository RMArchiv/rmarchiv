<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AwardSubcat
 *
 * @property int $id
 * @property string $title
 * @property string $desc_html
 * @property string $desc_md
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $page_id
 * @property int $cat_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereDescHtml($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereDescMd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat wherePageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardSubcat whereCatId($value)
 * @mixin \Eloquent
 */
class AwardSubcat extends Model
{
    protected $table = 'award_subcats';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'desc_html',
        'desc_md',
        'page_id',
        'cat_id'
    ];

    protected $guarded = [];

        
}