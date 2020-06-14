<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Helpers;

use App\Models\Game;

class InlineBoxHelper
{
    public static function GameBox($htmlcontent)
    {
        //Match for :123:
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
        $htmlcontent = self::StrikeText($htmlcontent);
        $htmlcontent = self::BlockQuote($htmlcontent);

        return $htmlcontent;
    }

    public static function TextColor($htmlcontent)
    {
        //Match for [color=CSSCODE]Text[/color]
        $htmlcontent = preg_replace('/\[color\=(.*?)\](.*?)\[\/color\]/', '<span style="color: $1;">$2</span>', $htmlcontent);

        return $htmlcontent;
    }

    public static function StrikeText($htmlcontent){
        //match for ~~~Text~~
        $htmlcontent = preg_replace('/(~{2})(.*?)(~{2})/', '<s>$2</s>', $htmlcontent);

        return $htmlcontent;
    }

    public static function BlockQuote($mhtmcontent){
        $mhtmcontent = str_replace('<blockquote>', '<blockquote class="blockquote">', $mhtmcontent);
        return $mhtmcontent;
    }
}
