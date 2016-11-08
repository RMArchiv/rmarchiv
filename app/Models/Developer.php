<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Developer
 *
 * @property integer $id
 * @property string $name
 * @property string $short
 * @property string $website_url
 * @property integer $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereShort($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Developer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Developer extends Model
{
    protected $table = 'developer';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'short',
        'website_url',
        'user_id'
    ];

    protected $guarded = [];

        
}