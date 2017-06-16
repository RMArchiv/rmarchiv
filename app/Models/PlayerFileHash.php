<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayerFileHash
 *
 * @property int $id
 * @property string $filehash
 * @property int $supported
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereFilehash($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereSupported($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PlayerFileHash whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlayerFileHash extends Model
{
    public $timestamps = true;
    protected $table = 'player_file_hashes';
    protected $fillable = [
        'filehash',
        'supported',
        'description'
    ];

    protected $guarded = [];

        
}