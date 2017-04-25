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
        $res['music\/opening1'] = 'rtp\/2000_music_opening1.mid';
        $res['music\/opening2'] = 'rtp\/2000_music_opening2.mid';
        $res['music\/opening3'] = 'rtp\/2000_music_opening3.mid';
        $res['sound\/decision1'] = 'rtp\/2000_sound_decision1.wav';
        $res['sound\/decision2'] = 'rtp\/2000_sound_decision2.wav';
        $res['system\/system'] = 'rtp\/2000_system_system.png';
        $res['title\/title1'] = 'rtp\/2000_title_title1.png';
        $res['title\/title2'] = 'rtp\/2000_title_title2.png';
        $res['title\/title3'] = 'rtp\/2000_title_title3.png';
        $res['title\/title4'] = 'rtp\/2000_title_title4.png';
        

        // $res[''] = '';

        $return = str_replace('\/', '/' ,\GuzzleHttp\json_encode($res, JSON_UNESCAPED_SLASHES));

        return  $return;
    }
}
