<?php

namespace App\Http\Controllers;

use App\Models\GamesSavegame;
use Illuminate\Http\Request;
use PhpBinaryReader\BinaryReader;

class SavegameManagerController extends Controller
{
    public function index()
    {
        $savegames = GamesSavegame::whereUserId(\Auth::id())
            ->groupBy('gamefile_id')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('savegamemanager.index', [
            'games' => $savegames,
        ]);
    }

    public function show($gamefile_id)
    {
        $savegames = GamesSavegame::whereUserId(\Auth::id())
            ->where('gamefile_id', '=', $gamefile_id)
            ->orderBy('updated_at', 'desc')
            ->first();

        $data = base64_decode($savegames->save_data);

        $br = new BinaryReader($data);

        $array = array();
        $br->setPosition(0);

        for ($i = 0; $i <= 10; $i++) {
            $t['i'] = $i;
            $t['pos'] = $br->getPosition();
            $t['int8'] = $br->readInt8();
            $t['string'] = $br->readString($t['int8']);
            $array[] = $t;
            $br->setPosition($br->getPosition());
        }

        dd($array);
    }

    public function delete($game_id, $savegame_id)
    {

    }
}
