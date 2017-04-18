<?php

namespace App\Http\Controllers;

use App\Models\GamesFile;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index($gameid, $gamefileid){
        $gf = GamesFile::whereGameId($gameid)
            ->where('id', '=', $gamefileid)
            ->first();

        $gfpath = storage_path('app/public/'.$gf->filename);
        $playerpath = storage_path('app/public/player/'.$gameid.'/');

        if($gf->extension == '7z'){

        }elseif($gf->extension == 'zip'){

        }

        dd($gf);
        return view('player.index');
    }
}
