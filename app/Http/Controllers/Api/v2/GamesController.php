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

        $games = Game::get();

        $result = array();

        foreach ($games as $game) {
            $g['id'] = $game->id;
            $g['title'] = $game->title;
            $g['subtitle'] = $game->subtitle;

            $devs = GamesDeveloper::whereGameId($game->id)->get();

            foreach ($devs as $dev) {
                $d['id'] = $dev->developer_id;
                $d['name'] = $dev->developer->name;

                $g['developers'][] = $d;
            }

            $result[] = $g;
        }

        return response()->json([
            'status_code' => 200,
            'message'     => 'List of games',
            'data'        => $result,
        ]);
    }
}
