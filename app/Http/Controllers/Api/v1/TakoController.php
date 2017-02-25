<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\GamesFile;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Middleware\Debugbar;

class TakoController extends Controller
{
    public function filelist()
    {
        $list = GamesFile::with('gamefiletype', 'game')->get(); //->take(5);

        return $list;
    }
}
