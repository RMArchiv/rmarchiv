<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v1;

use App\Models\Game;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
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
        $game = Game::with('developers', 'maker', 'screenshots', 'comments')->whereId($id)->first();

        return $game->toArray();
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
