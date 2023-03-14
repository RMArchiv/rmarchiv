<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function index(){
        $games = Game::whereClientVisible(1)->get();

        return $games;
    }
}
