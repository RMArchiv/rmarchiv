<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function index(){
        return Game::select([
            'id',
            'title',
            'subtitle',
        ])
            ->get();
    }
}
