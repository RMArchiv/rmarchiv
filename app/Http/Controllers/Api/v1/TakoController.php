<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Game;
use App\Models\GamesFile;
use App\Http\Controllers\Controller;

class TakoController extends Controller
{
    public function filelist()
    {
        $list = GamesFile::with('gamefiletype', 'game.maker' )->get(); //->take(5);

        return $list;
    }

    public function getdevelopers($gameid)
    {
        $devs = Game::whereId($gameid)->first();

        $res = [];

        foreach ($devs->developers()->get() as $dev) {
            return $dev->developer->name;
        }
    }
}
