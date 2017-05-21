<?php

namespace App\Http\Controllers;

use App\Models\GamesSavegame;
use Illuminate\Http\Request;

class SavegameController extends Controller
{
    public function index($gamefileid){

    }

    public function show($gamefileid, $slotid){

    }

    public function api_load($gamefileid){
        //Load Savegame Data from Database
        $savegames = GamesSavegame::whereGamefileId($gamefileid)
            ->where('user_id', '=', \Auth::id())
            ->get();

        $ret = [];

        foreach($savegames as $s){
            $ret[$s->slot_id] = $s->save_data;
        }

        return $ret;
    }

    public function api_save(Request $request ,$gamefileid){
        $data = json_decode($request->json(), true);

        foreach($data as $name => $value){
            $save = GamesSavegame::where([
                'user_id' => \Auth::id(),
                'gamefile_id' => $gamefileid,
                'slot_id' => $name,
            ])
                ->first();

            if(!$save){
                $s = new GamesSavegame;
                $s->save_data = $value;
                $s->slot_id = $name;
                $s->gamefile_id = $gamefileid;
                $s->user_id = \Auth::id();
                $s->save();
            }else{
                $save->save_data = $value;
                $save->save();
            }


        }

    }

}
