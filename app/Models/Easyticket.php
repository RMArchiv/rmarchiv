<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Easyticket.
 *
 * @property int $id
 * @property int $gamefile_id
 * @property int $user_id
 * @property int|null $savegame_id
 * @property string $userreport
 * @property string $player_version
 * @property string $known_patches
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereGamefileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereKnownPatches($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket wherePlayerVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereSavegameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Easyticket whereUserreport($value)
 * @mixin \Eloquent
 */
class Easyticket extends Model
{
    protected $table = 'easyticket';

    public $timestamps = true;

    protected $fillable = [
        'gamefile_id',
        'user_id',
        'savegame_id',
        'userreport',
        'player_version',
        'known_patches',
    ];

    protected $guarded = [];
}
