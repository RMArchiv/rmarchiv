<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Carbon\Carbon;
use Carbon\PHPStan\AbstractMacro;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index($datetime){
        $games = Game::where('updated_at', '>=', Carbon::parse($datetime))->get();

        $ret = [
            'info' => [
                'endpoint' => 'gamelist',
                'datetime' => $datetime,
            ],
            'data' => $games
        ];

        return $ret;
    }
}
