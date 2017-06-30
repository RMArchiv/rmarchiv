<?php

namespace App\Http\Controllers\Api\v2;

use App\Models\Game;
use App\Models\GamesDeveloper;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
