<?php

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\GamesFile;
use App\Models\GamesFilesType;
use App\Models\UserDownloadLog;
use Carbon\Carbon;
use Illuminate\Http\Request;


class GameFileController extends Controller
{

    public function download($id) {

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

        UserDownloadLog::insert([
            'user_id' => \Auth::id(),
            'gamefile_id' => $id,
            'created_at' => Carbon::now(),
        ]);

        $filepath = storage_path('app/public/'.$g->filename);

        $newfilename = $g->gametitle.' - '.$g->gamesubtitle.' ['.$g->filetype.'-'.$g->fileversion.']-'.str_pad($g->fileyear, 2, 0, STR_PAD_LEFT)
            .'-'.str_pad($g->filemonth, 2, 0, STR_PAD_LEFT).'-'.str_pad($g->fileday, 2, 0, STR_PAD_LEFT).'.'.$g->fileextension;

        return response()->download($filepath, $newfilename);
    }

    public function download_wo_count(Request $request) {
        $filepath = storage_path('app/public/'.$request->get('filename'));

        $newfilename = $request->get('id');

        return response()->download($filepath, $newfilename);
    }

    public function create($id) {
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
                'games.subtitle as gamesubtitle',
                'games.id as gameid',
                'games_files.deleted_at as deleted_at',
                'games_files.forbidden as forbidden',
                'games_files.reason as reason',
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

    public function store(Request $request, $id) {

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

        if ($exists === true) {
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

    public function destroy(Request $request, $id, $fileid) {

        $gf = GamesFile::whereId($fileid)->first();
        \Storage::delete($gf->filename);

        $gf->delete();

        return redirect()->route('gamefiles.index', [$id]);
    }

    public function edit($id, $gamefileid) {
        $gamefile = GamesFile::whereId($gamefileid)->first();
        $filetypes = GamesFilesType::get();

        return view('games.gamefiles_edit', [
            'gamefile' => $gamefile,
            'filetypes' => $filetypes,
        ]);
    }

    public function update(Request $request, $id, $gamefileid) {
        $this->validate($request, [
            //'uuid' => 'required',
            'version' => 'required',
            'releasedate_day' => 'required|not_in:0',
            'releasedate_month' => 'required|not_in:0',
            'releasedate_year' => 'required|not_in:0',
            'filetype' => 'required|not_in:0'
        ]);

        $gamefile = GamesFile::whereId($gamefileid)->first();

        $gamefile->release_version = $request->get('version');
        $gamefile->release_day = $request->get('releasedate_day');
        $gamefile->release_month = $request->get('releasedate_month');
        $gamefile->release_year = $request->get('releasedate_year');
        $gamefile->release_type = $request->get('filetype');

        if ($request->get('uuid')) {
            \Storage::delete($gamefile->filename);

            $storagetemp = 'temp/'.$request->get('uuid').'/file';
            $storagedest = 'games/'.$request->get('uuid').'.'.$request->get('ext');

            $meta['mime'] = \Storage::mimeType($storagetemp);
            $meta['size'] = \Storage::size($storagetemp);
            $meta['ext'] = $request->get('ext');

            $exists = \Storage::disk('local')->exists($storagetemp);

            if ($exists === true) {
                \Storage::move($storagetemp, $storagedest);
                $gamefile->filesize = $meta['size'];
                $gamefile->extension = $meta['ext'];
                $gamefile->filename = $storagedest;

            }
        }

        if ($request->get('forbidden') && ($request->get('forbidden') <> '')) {
            $gamefile->forbidden = 1;
            $gamefile->reason = $request->get('forbidden');
        }else {
            $gamefile->forbidden = 0;
            $gamefile->reason = '';
        }

        $gamefile->save();

        return redirect()->route('gamefiles.index', [$id]);
    }
}
