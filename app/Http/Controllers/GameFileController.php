<?php

namespace App\Http\Controllers;

use App\Events\Obyx;
use Carbon\Carbon;
use Illuminate\Http\Request;


class GameFileController extends Controller
{

    public function download($id){

        \DB::table('games_files')
            ->where('id', '=', $id)
            ->increment('downloadcount');

        $g = \DB::table('games')
            ->select([
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'games_files.filename as filename',
                'games_files.extension as fileextension',
                'games_files_types.title as filetype',
                'games_files.release_version as fileversion',
                'games_files.release_day as fileday',
                'games_files.release_month as filemonth',
                'games_files.release_year as fileyear',
            ])
            ->leftJoin('games_files', 'games.id', '=', 'games_files.game_id')
            ->leftJoin('games_files_types', 'games_files.release_type', '=', 'games_files_types.id')
            ->where('games_files.id', '=', $id)
            ->limit(1)
            ->first();

        $filepath = storage_path('app/public/'.$g->filename);

        $newfilename = $g->gametitle.' - '.$g->gamesubtitle.' ['.$g->filetype.'-'.$g->fileversion.']-'.str_pad($g->fileyear, 2, 0, STR_PAD_LEFT)
            .'-'.str_pad($g->filemonth, 2, 0, STR_PAD_LEFT).'-'.str_pad($g->fileday, 2, 0, STR_PAD_LEFT).'.'.$g->fileextension;

        return response()->download($filepath, $newfilename);
    }

    public function create($id){
        $gamefiles = \DB::table('games_files')
            ->select([
                'games_files.id as fileid',
                'games_files_types.title as filetypetitle',
                'games_files_types.short as filetypeshort',
                'games_files.release_version as fileversion',
                'games_files.filename as filename',
                'games_files.extension as fileextension',
                'games_files.filesize as filesize',
                'games_files.release_year as fileyear',
                'games_files.release_month as filemonth',
                'games_files.release_day as fileday',
                'users.id as userid',
                'users.name as username',
                'games_files.created_at as filecreated_at',
                'games_files.downloadcount as downloadcount',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle'
            ])
            ->leftJoin('games_files_types', 'games_files.release_type', '=', 'games_files_types.id')
            ->leftJoin('users', 'games_files.user_id', '=', 'users.id')
            ->leftJoin('games', 'games.id', '=', 'games_files.game_id')
            ->where('games_files.game_id', '=', $id)
            ->orderBy('games_files_types.id', 'desc')
            ->orderBy('fileyear', 'desc')
            ->orderBy('filemonth', 'desc')
            ->orderBy('fileday', 'desc')
            ->get();

        $filetypes = \DB::table('games_files_types')
            ->get();

        return view('games.gamefiles', [
            'gamefiles' => $gamefiles,
            'filetypes' => $filetypes,
            'gameid' =>  $id,
        ]);
    }

    public function store(Request $request, $id){
/*
   +request: ParameterBag {#41 ▼
    #parameters: array:9 [▼
      "_token" => "wTPL1yBVVilQG62BNCGxolpfJIir0bAfU550Dapx"
      "filetype" => "0"
      "version" => ""
      "releasedate_day" => "0"
      "releasedate_month" => "0"
      "releasedate_year" => "0"
      "qqfile" => ""
      "uuid" => "2f4ce7c7-0b07-4186-9683-bd63e7cc1ed1"
      "filename" => "undefined"
    ]
  }
 */

        $this->validate($request, [
            'uuid' => 'required',
            'version' => 'required',
            'releasedate_day' => 'required|not_in:0',
            'releasedate_month' => 'required|not_in:0',
            'releasedate_year' => 'required|not_in:0',
            'filetype' => 'required|not_in:0'
        ]);

        $storagetemp = 'temp/'.$request->get('uuid').'/file';
        $storagedest = 'games/'.$request->get('uuid').'.'.$request->get('ext');

        $meta['mime'] = \Storage::mimeType($storagetemp);
        $meta['size'] = \Storage::size($storagetemp);
        $meta['ext'] = $request->get('ext');

        $exists = \Storage::disk('local')->exists($storagetemp);

        if($exists === true){
            \Storage::move($storagetemp, $storagedest);

            \DB::table('games_files')->insert([
                'game_id' => $id,
                'filesize' => $meta['size'],
                'extension' => $meta['ext'],
                'release_type' => $request->get('filetype'),
                'release_version' => $request->get('version'),
                'release_day' => $request->get('releasedate_day'),
                'release_month' => $request->get('releasedate_month'),
                'release_year' => $request->get('releasedate_year'),
                'user_id' => \Auth::id(),
                'filename' => $storagedest,
                'created_at' => Carbon::now(),
            ]);

            event(new Obyx('gamefile-add', \Auth::id()));

            return redirect()->route('gamefiles.index', [$id]);
        }

    }

    public function destroy(Request $request, $id){

    }
}
