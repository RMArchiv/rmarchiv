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
            ->orderBy('slot_id', 'asc')
            ->get();

        $array = array();

        foreach ($savegames as $savegame) {
            $t['slot'] = $savegame->slot_id;
            $t['data'] = $this->get_lsd_headerdata($savegame->save_data, $gamefile_id);
            $t['date'] = $savegame->updated_at;

            $array[] = $t;
        }

        return view('savegamemanager.show', [
            'savegames' => $array
        ]);
    }

    public function delete($game_id, $savegame_id)
    {

    }

    function get_lsd_headerdata($data, $gamefile_id){
        $data = base64_decode($data);

        dd($data);
        $br = new BinaryReader($data);

        $array = array();
        $br->setPosition(0);

        $array['header']['length'] = $br->readInt8();
        $array['header']['data'] = $br->readString($array['header']['length']);

        $cat = $br->readInt8();
        $br->readInt8();
        $br->readInt8();
        $array[$cat]['date']['length'] = $br->readInt8();
        $array[$cat]['date']['data'] = $br->readString($array[$cat]['date']['length']);

        $array[$cat]['char1_name']['idx'] = $br->readInt8();
        $array[$cat]['char1_name']['length'] = $br->readInt8();
        $array[$cat]['char1_name']['data'] = $br->readString($array[$cat]['char1_name']['length']);

        $array[$cat]['char1_level']['idx'] = $br->readInt8();
        $array[$cat]['char1_level']['length'] = $br->readInt8();
        $array[$cat]['char1_level']['data'] = $br->readInt8();

        $array[$cat]['char1_hp']['idx'] = $br->readInt8();
        $array[$cat]['char1_hp']['length'] = $br->readInt8();
        if($array[$cat]['char1_hp']['length'] == 2){
            $array[$cat]['char1_hp']['data'] = $br->readInt16();
        }else{
            $array[$cat]['char1_hp']['data'] = $br->readInt8();
        }

        $array[$cat]['char1_face']['idx'] = $br->readInt8();
        $array[$cat]['char1_face']['length'] = $br->readInt8();
        $array[$cat]['char1_face']['data'] = $br->readString($array[$cat]['char1_face']['length']);

        $pc = new PlayerController();
        $files = json_decode($pc->deliver_indexjson($gamefile_id), true);

        $file = $files['faceset/'.strtolower($array[$cat]['char1_face']['data'])];

        $file = action('PlayerController@deliver_files', [$gamefile_id, $file]);

        $array[$cat]['char1_face']['url'] = $file;
        return $array;
    }
}
