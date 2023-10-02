<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\GamesDeveloper;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    use Helpers;

    public function index()
    {
        $games = Game::select([
            'id',
            'title',
            'subtitle',
            ])
            ->get();

        return $games;
    }

    public function show($id)
    {
        //Lade Spielinformationen
        $game = Game::whereId($id)->first();

        //Fülle Array
        $array = [
            'type'      => 'RpgGame',
            'version'   => 'rmapi_v1',
            'data_date' => Carbon::now()->toDateTimeString(),
            'game'      => [
                'id'               => $game->id,
                'title'            => $game->title,
                'subtitle'         => $game->subtitle,
                'release_date'     => $game->release_date,
                'description_md'   => $game->desc_md,
                'description_html' => $game->desc_html,
                'language'         => $game->language->short,
                'engine'           => $game->maker->short,
                'website'          => $game->website_url,
            ],
        ];

        //Lade Entwickler
        $developer = GamesDeveloper::whereGameId($id)->get();
        $t = [];
        foreach ($developer as $dev) {
            $t[$dev->developer->id] = $dev->developer->name;
        }
        $array['game']['developers'] = $t;

        //Lade Tags
        $t_tag = [];
        foreach($game->tags as $tag){
            $t_tag[$tag->tag_id] = $tag->tag->title;
        }
        $array['game']['tags'] = $t_tag;

        //Lade Gamefiles
        $t_files = [];
        foreach($game->gamefiles as $gf){
            $t_files[$gf->id]['release_type'] = $gf->gamefiletype->title;
            $t_files[$gf->id]['release_version'] = $gf->release_version;
            $t_files[$gf->id]['release_date'] = $gf->release_year.'-'.str_pad($gf->release_month,2,0,STR_PAD_LEFT).'-'.str_pad($gf->release_day,2,0,STR_PAD_LEFT);
            $t_files[$gf->id]['release_language'] = $gf->language->name;
        }
        $array['game']['gamefiles'] = $t_files;

        return $array;
    }

    public function show_app()
    {
        $games = Game::with('developers', 'user', 'maker', 'screenshots')->orderBy('created_at')->limit(25)->get();

        $jason = [
            '$jason' => [
                'head' => [
                    'title'       => 'rmarchiv',
                    'description' => 'description',
                    'offline'     => true,
                    'body'        => [
                        'type'  => 'label',
                        'text'  => 'Dies ist Zeile 1',
                        'style' => [
                            'font'    => 'HelveticaNeue',
                            'size'    => 20,
                            'color'   => '#ff0000',
                            'padding' => '10',
                        ],
                    ],
                ],
            ],
        ];

        return $jason;
    }
}
