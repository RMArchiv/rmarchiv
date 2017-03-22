<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Helpers;

use App\Models\Game;

class InlineBoxHelper
{
    public static function GameBox($htmlcontent){
        preg_match_all('/\:([0-9]+)\:/', $htmlcontent, $match);

        foreach ($match[1] as $item) {
            $game = Game::whereId($item)->first();

            $html = view('_partials.inline_gamebox', [
                'game' => $game,
            ]);

            if($game){
                $htmlcontent = str_replace(':'.$item.':', $html, $htmlcontent);
            }
        }

        return $htmlcontent;
    }
}
