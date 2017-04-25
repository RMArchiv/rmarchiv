<?php

namespace App\Http\Controllers;

use App\Models\GamesFile;
use App\Models\PlayerIndexjson;
use Composer\Package\Archiver\ZipArchiver;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index($gamefileid){
        return view('player.index');
    }

    public function deliver_files($gamefileid, $fileid){
        $gf = GamesFile::whereId($gamefileid)->first();
        $file = PlayerIndexjson::whereId($fileid)->first();

        $path = storage_path('app/public/'.$gf->filename);
        $zip = new \ZipArchive;
        $zip->open($path);
        $fp = $zip->getFromName($file->filename);

        return $fp;
    }

    public function deliver_rtp($gamefileid, $filename){
        $path = storage_path('app/public/rtp/'.$filename);
        return response()->download($path);
    }

    public function deliver_indexjson($gamefileid){
        $index = PlayerIndexjson::whereGamefileId($gamefileid)->get();

        $res = array();
        foreach ($index as $ind) {
            $res[$ind->key] = $ind->id;
        }

        $res['system\/system'] = 'rtp\/2000_system_system.png';
        $res['sound\/decision1'] = 'rtp\/2000_sound_decision1.wav';
        // $res[''] = '';

        $return = str_replace('\/', '/' ,\GuzzleHttp\json_encode($res, JSON_UNESCAPED_SLASHES));

        return  $return;
    }
}
