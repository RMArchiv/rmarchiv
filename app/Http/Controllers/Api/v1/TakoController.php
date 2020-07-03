<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Game;
use App\Models\GamesFile;
use App\Http\Controllers\Controller;
use App\Models\Maker;

class TakoController extends Controller
{
    public function filelist2(){
        $list = Game::with('gamefiles', 'maker', 'developers', 'developers.developer')->get();

        return $list;
    }

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

    public function getMakers(){
        $maker = Maker::all();

        return $maker;
    }
}
