<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\GamesFile;
use App\Models\GamesDeveloper;
use App\Models\PlayerFileHash;
use App\Http\Controllers\Controller;
use App\Models\PlayerFileGamefileRel;

/**
 * Class EasyRPGController
 * @package App\Http\Controllers\Api\v1
 *
 * Class for EasyRPG related stuff
 */
class EasyRPGController extends Controller
{
    /**
     * return index of all gamefile_ids with filehash
     * @return array
     */
    public function index()
    {
        $hashes = PlayerFileGamefileRel::where('orig_filename', 'like', '%rpg_rt.ldb%')
            ->join('player_file_hashes', 'player_file_hashes.id', 'player_file_gamefile_rel.file_hash_id')
            ->select([
                'player_file_gamefile_rel.gamefile_id',
                'player_file_hashes.filehash',
            ])
            ->get();

        $array = [
            'type'  => 'hashlist',
            'count' => $hashes->count(),
            'data'  => $hashes->toArray(),
        ];

        return $array;
    }

    /**
     * Get all filenames with hash.
     * @param $ldbhash
     * @return array
     */
    public function show($ldbhash)
    {
        $hashid = PlayerFileHash::whereFilehash($ldbhash)->first()->id;
        $gamefileid = PlayerFileGamefileRel::whereFileHashId($hashid)->first()->gamefile_id;
        $gamefile = GamesFile::whereId($gamefileid)->first();

        //Lade Spielinformationen
        $game = Game::whereId($gamefile->game_id)->first();

        //Fülle Array
        $array = [
            'type'      => 'RpgGame',
            'version'   => 'rmapi_v1',
            'data_date' => Carbon::now()->toDateTimeString(),
            'data'      => [
                'identifier'   => $ldbhash,
                'title'        => $game->title,
                'subtitle'     => $game->subtitle,
                'release_date' => Carbon::create($gamefile->release_year, $gamefile->release_month, $gamefile->release_day)->toDateString(),
                'developers'   => '',
                'language'     => $game->language->short,
                'engine'       => $game->maker->short,
                'release_type' => $gamefile->gamefiletype->short,
                'files'        => '',
            ],
        ];

        //Lade Entwickler
        $developer = GamesDeveloper::whereGameId($game->id)->get();
        $t = [];
        foreach ($developer as $dev) {
            $t[] = $dev->developer->name;
        }
        $array['data']['developers'] = $t;

        //Lade Dateien
        $files = PlayerFileGamefileRel::whereGamefileId($gamefileid)->get();
        $t = [];
        foreach ($files as $f) {
            $t[$f->orig_filename] = $f->filehash->filehash;
        }
        $array['data']['files'] = $t;

        return $array;
    }
}
