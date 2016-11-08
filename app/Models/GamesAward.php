<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesAward
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $developer_id
 * @property integer $award_cat_id
 * @property integer $award_page_id
 * @property integer $user_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereGameId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereDeveloperId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereAwardCatId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereAwardPageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\GamesAward whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GamesAward extends Model
{
    protected $table = 'games_awards';

    public $timestamps = true;

    protected $fillable = [
        'game_id',
        'developer_id',
        'award_cat_id',
        'award_page_id',
        'user_id'
    ];

    protected $guarded = [];

        
}