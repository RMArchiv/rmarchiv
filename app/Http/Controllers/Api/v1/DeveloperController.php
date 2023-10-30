<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GamesDeveloper;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function show($id){
        $games = [];

        $ids = GamesDeveloper::whereDeveloperId($id)->get();

        foreach ($ids as $game){
            $tgame = [];
            $tgame['id'] = $game->game->id;
            $tgame['title'] = $game->game->title;
            $tgame['subtitle'] = $game->game->subtitle;

            $games[] = $tgame;
        }

        return $games;
    }
}
