<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Maker.
 *
 * @property int $id
 * @property string $title
 * @property string $short
 * @property string $website_url
 * @property int $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Maker whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read \App\Models\Game $game
 */
class Maker extends Model
{
    protected $table = 'makers';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'short',
        'website_url',
        'user_id',
    ];

    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }
}
