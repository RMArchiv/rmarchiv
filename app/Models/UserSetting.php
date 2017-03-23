<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSetting.
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_admin
 * @property int $is_moderator
 * @property string $avatar_path
 * @property int $is_banned
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsAdmin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsModerator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereAvatarPath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereIsBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property int $disable_widget_msg
 * @property int $disable_widget_cdc
 * @property int $disable_widget_gamesreleased
 * @property int $disable_widget_gamesadded
 * @property int $disable_widget_topmonth
 * @property int $disable_widget_alltimetop
 * @property int $disable_widget_news
 * @property int $disable_widget_board
 * @property int $disable_widget_shoutbox
 * @property int $disable_widget_search
 * @property int $disable_widget_tags
 * @property int $disable_widget_stats
 * @property int $disable_widget_obyx
 * @property int $disable_widget_comments
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetAlltimetop($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetBoard($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetCdc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetComments($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetGamesadded($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetGamesreleased($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetMsg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetNews($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetObyx($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetSearch($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetShoutbox($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetStats($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetTags($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereDisableWidgetTopmonth($value)
 * @property int $rows_per_page_developer
 * @property int $rows_per_page_games
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereRowsPerPageDeveloper($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserSetting whereRowsPerPageGames($value)
 */
class UserSetting extends Model
{
    use \Venturecraft\Revisionable\RevisionableTrait;
    protected $table = 'user_settings';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'is_admin',
        'is_moderator',
        'avatar_path',
        'is_banned',
        'disable_widget_msg',
        'disable_widget_cdc',
        'disable_widget_gamesreleased',
        'disable_widget_gamesadded',
        'disable_widget_topmonth',
        'disable_widget_alltimetop',
        'disable_widget_news',
        'disable_widget_board',
        'disable_widget_shoutbox',
        'disable_widget_search',
        'disable_widget_tags',
        'disable_widget_stats',
        'disable_widget_obyx',
        'disable_widget_comments',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }
}
