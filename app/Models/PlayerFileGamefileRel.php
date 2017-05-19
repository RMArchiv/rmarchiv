<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayerFileGamefileRel
 *
 * @property int $id
 * @property int $gamefile_id
 * @property int $file_hash_id
 * @property string $orig_filename
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereFileHashId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereGamefileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereOrigFilename($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileGamefileRel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlayerFileGamefileRel extends Model
{
    protected $table = 'player_file_gamefile_rel';

    public $timestamps = true;

    protected $fillable = [
        'gamefile_id',
        'file_hash_id',
        'orig_filename'
    ];

    protected $guarded = [];

    public function filehash(){
        return $this->hasOne('App\Models\PlayerFileHash', 'id', 'file_hash_id');
    }
}