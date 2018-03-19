<?php
/**
 * Created by PhpStorm.
 * User: ryg
 * Date: 21.08.17
 * Time: 09:04.
 */

namespace App\Helpers;

use App\Models\Game;

class SearchFilterHelper
{
    public static function searchFilter($searchterm)
    {
        $result = [];
        $result['searchterm'] = $searchterm;

        preg_match_all('/maps:([0-9]+)/', $searchterm, $match);
        foreach ($match[1] as $item) {
            $game = Game::whereId($item)->first();
            $t['type'] = 'maps';
            $t['value'] = $item;
            $result['filter'][] = $t;
            $result['searchterm'] = str_replace($t['type'].':'.$t['value'], '', $result['searchterm']);
        }

        preg_match_all('/maps-min:([0-9]+)/', $searchterm, $match);
        foreach ($match[1] as $item) {
            $game = Game::whereId($item)->first();
            $t['type'] = 'maps-min';
            $t['value'] = $item;
            $result['filter'][] = $t;
            $result['searchterm'] = str_replace($t['type'].':'.$t['value'], '', $result['searchterm']);
        }

        preg_match_all('/maps-max:([0-9]+)/', $searchterm, $match);
        foreach ($match[1] as $item) {
            $game = Game::whereId($item)->first();
            $t['type'] = 'maps-max';
            $t['value'] = $item;
            $result['filter'][] = $t;
            $result['searchterm'] = str_replace($t['type'].':'.$t['value'], '', $result['searchterm']);
        }

        return $result;
    }
}
