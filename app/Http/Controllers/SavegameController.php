<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GamesSavegame;

class SavegameController extends Controller
{
    public function index($gamefileid)
    {
    }

    public function show($gamefileid, $slotid)
    {
    }

    public function api_load($gamefileid)
    {
        //Load Savegame Data from Database
        $savegames = GamesSavegame::whereGamefileId($gamefileid)
            ->where('user_id', '=', \Auth::id())
            ->get();

        $ret = [];

        foreach ($savegames as $s) {
            $ret[$s->slot_id] = $s->save_data;
        }

        return response()->json($ret);
    }

    public function api_save(Request $request, $gamefileid)
    {
        $payLoad = json_decode(request()->getContent(), true);

        \Log::info('savegamecount: '.count($payLoad));

        foreach ($payLoad as $key=>$value) {
            \Log::info('slot: '.$key);
            \Log::info('data: '.$value);
            $save = GamesSavegame::where([
                'user_id'     => $user = \Auth::id(),
                'gamefile_id' => $gamefileid,
                'slot_id'     => $key,
                ])
                ->first();

            if (! $save) {
                $s = new GamesSavegame();
                $s->save_data = $value;
                $s->slot_id = $key;
                $s->gamefile_id = $gamefileid;
                $s->user_id = \Auth::id();
                $s->save();
                \Log::info('created');
            } else {
                $save->save_data = $value;
                $save->save();
                \Log::info('updated');
            }
        }
    }

    public function api_save_slot(Request $request, $gamefileid, $slot)
    {
        $value = request()->getContent();
        $key = $slot;

        \Log::info('slot: '.$key);
        \Log::info('data: '.$value);
        $save = GamesSavegame::where([
            'user_id'     => $user = \Auth::id(),
            'gamefile_id' => $gamefileid,
            'slot_id'     => $key,
            ])
            ->first();

        if (! $save) {
            $s = new GamesSavegame();
            $s->save_data = $value;
            $s->slot_id = $key;
            $s->gamefile_id = $gamefileid;
            $s->user_id = \Auth::id();
            $s->save();
            \Log::info('created');
        } else {
            $save->save_data = $value;
            $save->save();
            \Log::info('updated');
        }
    }
}
