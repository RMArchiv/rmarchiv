<?php

namespace App\Http\Controllers;

use App\Models\GamesSavegame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        $data = Input::all();

        foreach($data as $key=>$value){
            $save = GamesSavegame::where([
                'user_id' => \Auth::id(),
                'gamefile_id' => $gamefileid,
                'slot_id' => $key,
            ])
                ->first();

            dd($save);

            if(isnull($save)){
                $s = new GamesSavegame;
                $s->save_data = $value;
                $s->slot_id = $key;
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
