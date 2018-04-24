<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 * (c) 2018 by Gabriel 'Ghabry' Kind
 */

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamesFile;
use App\Models\PlayerIndexjson;

class PlayerMvController extends Controller
{
    public function index($gamefileid)
    {
        if (\Auth::check()) {
            $gamefile = GamesFile::whereId($gamefileid)->first();
            $path = storage_path('app/public/'.$gamefile->filename);
            $game = Game::whereId($gamefile->game_id)->first();

            $index = PlayerIndexjson::whereGamefileId($gamefileid)->first();
            $zip = new \ZipArchive();
            $zip->open($path);
            $fp = $zip->getFromName($index->value.'index.html');

            return view('playermv.index', [
                'gamefileid' => $gamefileid,
                'game'       => $game,
                'index'      => $fp
            ]);
        } else {
            return redirect()->action('IndexController@index');
        }
    }

    public function deliver($gamefileid, $filename)
    {
        $gf = GamesFile::whereId($gamefileid)->first();
        $index = PlayerIndexjson::whereGamefileId($gamefileid)->first();

        $path = storage_path('app/public/'.$gf->filename);
        //echo $path;
        $zip = new \ZipArchive();
        $zip->open($path);
        $fp = $zip->getFromName($index->value.$filename);
        //dd($fp);
        $t = 'application/octet-stream';

        if (ends_with($filename, ".js") == true){
          $t = 'application/javascript';}
        else if (ends_with($filename, ".css") == true){
          $t = 'text/css';}


        return response($fp, 200)->header('Content-Type', $t);
    }
}
