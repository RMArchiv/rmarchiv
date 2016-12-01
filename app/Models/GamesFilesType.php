<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GamesFilesType
 */
class GamesFilesType extends Model
{
    protected $table = 'games_files_types';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'short'
    ];

    protected $guarded = [];

        
}