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
            'type' => 'RpgGame',
            'version' => 'rmapi_v1',
            'data_date' => Carbon::now()->toDateTimeString(),
            'game' => [
                'title' => $game->title,
                'subtitle' => $game->subtitle,
                'release_date' => $game->release_date,
                'developers' => '',
                'language' => $game->language->short,
                'engine' => $game->maker->short,
            ],
        ];

        //Lade Entwickler
        $developer = GamesDeveloper::whereGameId($id)->get();
        $t = [];
        foreach ($developer as $dev) {
            $t[] = $dev->developer->name;
        }
        $array['game']['developer'] = $t;

        //Lade Tags

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
