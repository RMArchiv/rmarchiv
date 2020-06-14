<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayerFeedback.
 *
 * @property int $id
 * @property int $gamefile_id
 * @property int $user_id
 * @property string $issue_desc
 * @property string $known_patches
 * @property string $steps_to
 * @property int $savegame_slot
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereGamefileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereIssueDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereKnownPatches($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereSavegameSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereStepsTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerFeedback query()
 */
class PlayerFeedback extends Model
{
    public $timestamps = true;
    protected $table = 'player_feedback';
    protected $fillable = [
        'gamefile_id',
        'user_id',
        'issue_desc',
        'known_patches',
        'steps_to',
        'savegame_slot',
    ];

    protected $guarded = [];
}
