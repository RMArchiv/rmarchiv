<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ScreenshotController extends Controller
{
    public function show($gameid, $screenid){
        $s = \DB::table('screenshots')
            ->where('game_id', '=', $gameid)
            ->where('screenshot_id', '=', $screenid)
            ->get();

        $storagePath = '';

        //Prüfen ob Screenshots vorhanden sind
        if($s){//Es sind keine Screenshots vorhanden
            $storagePath = public_path().'/assets/no_image.png';
        }else{//Es sind Screenshots vorhanden
            $storagePath = \Storage::get('screenshots/'.$gameid.'.'.$screenid.'.png');
        }

        return Image::make($storagePath)->response();
    }

    public function create($gameid, $screenid){

    }

    public function upload($gameid, $screenid){

    }
}
