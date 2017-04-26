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

        $res['charset\/chara1'] = 'rtp\/charset_chara1.png';
        $res['charset\/chara2'] = 'rtp\/charset_chara2.png';
        $res['charset\/chara3'] = 'rtp\/charset_chara3.png';
        $res['charset\/chara4'] = 'rtp\/charset_chara4.png';
        $res['charset\/object1'] = 'rtp\/charset_object1.png';
        $res['charset\/object2'] = 'rtp\/charset_object2.png';
        $res['charset\/object3'] = 'rtp\/charset_object3.png';
        $res['charset\/object6'] = 'rtp\/charset_object6.png';
        $res['charset\/object9'] = 'rtp\/charset_object9.png';
        $res['charset\/objecta'] = 'rtp\/charset_objecta.png';
        $res['charset\/objectb'] = 'rtp\/charset_objectb.png';
        $res['charset\/objectc'] = 'rtp\/charset_objectc.png';
        $res['charset\/objectd'] = 'rtp\/charset_objectd.png';
        $res['charset\/objecte'] = 'rtp\/charset_objecte.png';
        $res['charset\/objectf'] = 'rtp\/charset_objectf.png';
        $res['charset\/objectg'] = 'rtp\/charset_objectg.png';
        $res['charset\/objecth'] = 'rtp\/charset_objecth.png';
        $res['charset\/objecti'] = 'rtp\/charset_objecti.png';
        $res['charset\/objectj'] = 'rtp\/charset_objectj.png';
        $res['charset\/objectk'] = 'rtp\/charset_objectk.png';
        $res['charset\/objectl'] = 'rtp\/charset_objectl.png';

        $res['chipset\/basis'] = 'rtp\/chipset_basis.png';
        $res['chipset\/outline'] = 'rtp\/chipset_outline.png';

        $res['music\/hero1'] = 'rtp\/music_hero1.mid';
        $res['music\/hero2'] = 'rtp\/music_hero2.mid';
        $res['music\/opening1'] = 'rtp\/music_opening1.mid';
        $res['music\/opening2'] = 'rtp\/music_opening2.mid';
        $res['music\/opening3'] = 'rtp\/music_opening3.mid';
        $res['music\/town1'] = 'rtp\/music_town1.mid';
        $res['music\/town2'] = 'rtp\/music_town2.mid';
        $res['music\/town3'] = 'rtp\/music_town3.mid';
        $res['music\/town4'] = 'rtp\/music_town4.mid';
        $res['music\/town5'] = 'rtp\/music_town5.mid';

        $res['sound\/cursor1'] = 'rtp\/sound_cursor1.wav';
        $res['sound\/cursor2'] = 'rtp\/sound_cursor2.wav';
        $res['sound\/decision1'] = 'rtp\/sound_decision1.wav';
        $res['sound\/decision2'] = 'rtp\/sound_decision2.wav';

        $res['system\/blue'] = 'rtp\/system_blue.png';
        $res['system\/bof2sys'] = 'rtp\/system_bof2sys.png';
        $res['system\/bubbles'] = 'rtp\/system_bubbles.png';
        $res['system\/don_system'] = 'rtp\/system_don_system.png';
        $res['system\/ff2'] = 'rtp\/system_ff2.png';
        $res['system\/ff3'] = 'rtp\/system_ff3.png';
        $res['system\/incomsys'] = 'rtp\/system_incomsys.png';
        $res['system\/lightbluesystem'] = 'rtp\/system_lightbluesystem.png';
        $res['system\/lines'] = 'rtp\/system_lines.png';
        $res['system\/lufia2'] = 'rtp\/system_lufia2.png';
        $res['system\/mint'] = 'rtp\/system_mint.png';
        $res['system\/ogre_battle'] = 'rtp\/system_ogre_battle.png';
        $res['system\/purple'] = 'rtp\/system_purple.png';
        $res['system\/red_future'] = 'rtp\/system_red_future.png';
        $res['system\/redmenu3'] = 'rtp\/system_redmenu3.png';
        $res['system\/royal'] = 'rtp\/system_royal.png';
        $res['system\/sf2sys'] = 'rtp\/system_sf2sys.png';
        $res['system\/shoddy'] = 'rtp\/system_shoddy.png';
        $res['system\/system'] = 'rtp\/system_system.png';
        $res['system\/system01'] = 'rtp\/system_system01.png';
        $res['system\/system02'] = 'rtp\/system_system02.png';
        $res['system\/system03'] = 'rtp\/system_system03.png';
        $res['system\/windows01'] = 'rtp\/system_windows01.png';
        $res['system\/windows02'] = 'rtp\/system_windows02.png';

        $res['title\/title1'] = 'rtp\/title_title1.png';
        $res['title\/title2'] = 'rtp\/title_title2.png';
        $res['title\/title3'] = 'rtp\/title_title3.png';
        $res['title\/title4'] = 'rtp\/title_title4.png';

        // $res[''] = '';

        foreach ($index as $ind) {
            $res[$ind->key] = $ind->id;
        }

        $return = str_replace('\/', '/' ,\GuzzleHttp\json_encode($res, JSON_UNESCAPED_SLASHES));

        return  $return;
    }
}
