<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AwardPage.
 *
 * @property int $id
 * @property string $title
 * @property string $short
 * @property string $website_url
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AwardPage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AwardPage extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'award_pages';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'short',
        'website_url',
        'user_id',
    ];

    protected $guarded = [];
}
