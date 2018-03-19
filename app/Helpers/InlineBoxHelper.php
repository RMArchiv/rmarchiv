<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Helpers;

use App\Models\Game;

class InlineBoxHelper
{
    public static function GameBox($htmlcontent)
    {
        preg_match_all('/\:([0-9]+)\:/', $htmlcontent, $match);

        foreach ($match[1] as $item) {
            $game = Game::whereId($item)->first();

            $html = view('_partials.inline_gamebox', [
                'game' => $game,
            ]);

            if ($game) {
                $htmlcontent = str_replace(':'.$item.':', $html, $htmlcontent);
            }
        }

        $htmlcontent = self::TextColor($htmlcontent);

        return $htmlcontent;
    }

    public static function TextColor($htmlcontent)
    {
        $htmlcontent = preg_replace('/\[color\=(.*?)\](.*?)\[\/color\]/', '<span style="color: $1;">$2</span>', $htmlcontent);

        return $htmlcontent;
    }
}
