<?php

namespace App\Http\Controllers;

use App\Helpers\PlayerHelper;
use App\Models\Game;
use App\Models\GamesFile;
use App\Models\GamesSavegame;
use App\Models\PlayerFileHash;
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
        if (\Auth::check()) {
            $savegames = GamesSavegame::whereUserId(\Auth::id())
                ->where('gamefile_id', '=', $gamefile_id)
                ->orderBy('slot_id', 'asc')
                ->get();

            $gamefile = GamesFile::whereId($gamefile_id)->first();

            $array = array();

            foreach ($savegames as $savegame) {
                $t['id'] = $savegame->id;
                $t['slot'] = $savegame->slot_id;
                $t['data'] = $this->get_lsd_headerdata($savegame->save_data, $gamefile_id);
                $t['date'] = $savegame->updated_at;

                $array[] = $t;
            }

            return view('savegamemanager.show', [
                'savegames'   => $array,
                'gamefile_id' => $gamefile_id,
                'gamefile'    => $gamefile,
            ]);
        } else {
            return redirect()->action('IndexController@index');
        }

    }

    function get_lsd_headerdata($data, $gamefile_id)
    {
        $data = base64_decode($data);

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
        if ($array[$cat]['char1_hp']['length'] == 2) {
            $array[$cat]['char1_hp']['data'] = $br->readInt16();
        } else {
            $array[$cat]['char1_hp']['data'] = $br->readInt8();
        }

        $array[$cat]['char1_face']['idx'] = $br->readInt8();
        $array[$cat]['char1_face']['length'] = $br->readInt8();
        $array[$cat]['char1_face']['data'] = $br->readString($array[$cat]['char1_face']['length']);
        $array[$cat]['char1_face']['img_idx'] = $br->readInt8();

        $pc = new PlayerController();
        $files = json_decode($pc->deliver_indexjson($gamefile_id), true);

        $file = $files['faceset/' . strtolower($array[$cat]['char1_face']['data'])];

        $file = action('PlayerController@deliver_files', [$gamefile_id, $file]);

        $array[$cat]['char1_face']['url'] = $file;
        return $array;
    }

    public function delete($savegame_id)
    {
        if (\Auth::check()) {
            $save = GamesSavegame::whereId($savegame_id)->where('user_id', '=', \Auth::id())->first();
            $save->forceDelete();
        }

        return redirect()->action('SavegameManagerController@show');
    }

    public function download($savegame_id)
    {
        if (\Auth::check()) {
            $save = GamesSavegame::whereId($savegame_id)->where('user_id', '=', \Auth::id())->first();
            $data = base64_decode($save->save_data);

            $filename = "Save" . str_pad($save->slot_id, 2, '0', STR_PAD_LEFT) . ".lsd";
            $headers = [
                'Content-type'        => 'application/octet-stream',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
                'Content-Length'      => sizeof($data)];
            return \Response::make($data, 200, $headers);
        }
    }

    public function store(Request $request)
    {
        if (\Auth::check()) {
            $this->validate($request, [
                'slot'        => 'required',
                'file'        => 'required',
                'gamefile_id' => 'required',
            ]);

            dd($request->file('file'));

            $data = file_get_contents($request->file('file')->getRealPath());

            if(PlayerHelper::getSavegameValidation($data) == true){
                $check = GamesSavegame::whereGamefileId($request->get('gamefile_id'))
                    ->where('user_id', '=', \Auth::id())
                    ->where('slot_is', '=', $request->get('slot'))
                    ->first();

                if ($check->count() == 0) {
                    $save = new GamesSavegame;
                    $save->gamefile_id = $request->get('gamefile_id');
                    $save->user_id = \Auth::id();
                    $save->save_data = base64_encode($data);
                    $save->slot_id = $request->get('slot');
                    $save->save();
                }else{
                    $check->save_data = base64_encode($data);
                    $check->save();
                }
            }
        }

        return redirect()->action('SavegameManagerController@show', $request->get('gamefile_id'));
    }
}
