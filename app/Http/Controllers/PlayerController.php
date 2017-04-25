<?php

namespace App\Http\Controllers;

use App\Models\GamesFile;
use App\Models\PlayerIndexjson;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index($gameid, $gamefileid){
        return view('player.index');
    }

    public function deliver_files($gameid, $gamefileid, $filename){

    }

    public function deliver_indexjson($gameid, $gamefileid){
        $index = PlayerIndexjson::whereGamefileId($gamefileid)->get();

        $res = array();
        foreach ($index as $ind) {
            $res[$ind->key] = $ind->value;
        }

        return \GuzzleHttp\json_encode($res);
    }
}
