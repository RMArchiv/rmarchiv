<?php

namespace App\Http\Controllers;

use App\Models\GamesFile;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index($gameid, $gamefileid){
        return view('player.index');
    }

    public function deliver_files($gameid, $gamefileid, $filename){

    }
}
