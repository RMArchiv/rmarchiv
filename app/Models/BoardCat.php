<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BoardCat
 *
 * @property integer $id
 * @property integer $order
 * @property string $title
 * @property string $desc
 * @property integer $last_user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $last_created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereDesc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereLastUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\BoardCat whereLastCreatedAt($value)
 * @mixin \Eloquent
 */
class BoardCat extends Model
{
    protected $table = 'board_cats';

    public $timestamps = true;

    protected $fillable = [
        'order',
        'title',
        'desc',
        'last_user_id',
        'last_created_at'
    ];

    protected $guarded = [];

        
}