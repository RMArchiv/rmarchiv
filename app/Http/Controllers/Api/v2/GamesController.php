<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Dingo\Api\Routing\Helpers;

class GamesController extends Controller
{
    use Helpers;

    public function __construct()
    {
        // Only apply to a subset of methods.
        //$this->middleware('api.auth', ['only' => ['index']]);
    }

    public function index()
    {
        \Debugbar::disable();

        $games = Game::select([
            'id',
            'title',
            'subtitle',
        ])
            ->get();

        return response()->json([
            'status_code' => 200,
            'message'     => 'List of games',
            'data'        => $games,
        ]);
    }
}
