<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Events\Obyx;
use App\Models\Game;
use App\Models\GamesFile;
use Illuminate\Http\Request;
use App\Models\GamesFilesType;
use App\Helpers\DatabaseHelper;
use App\Models\UserDownloadLog;

/**
 *
 */
class GameFileController extends Controller
{
    /**
     * This is the Download Function with simple directlink prevention
     * @param Request $request <p>Its unneeded but used...</p>
     * @param $id id of gamefile
     * @param $ts <p>unix timestamp. if older then 30 minutes redirect to gamepage</p>
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse|void
     */
    public function download(Request $request, $id, $ts = 0)
    {
        if ($request->isMethod('get')) {
            try {
                $g = \DB::table('games')
                    ->select([
                        'games.id as gameid',
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

                $curtime = time();
                if(($curtime-$ts) > 1800) { //If Download Link is older than 30 Minutes, redirect to GamePage
                    return \Redirect::action('GameController@show', ['id' => $g->gameid]);
                }else{
                    \DB::table('games_files')
                        ->where('id', '=', $id)
                        ->increment('downloadcount');

                    if (\Auth::check()) {
                        UserDownloadLog::insert([
                            'user_id' => \Auth::id(),
                            'gamefile_id' => $id,
                            'created_at' => Carbon::now(),
                        ]);
                    } else {
                        UserDownloadLog::insert([
                            'user_id' => 0,
                            'gamefile_id' => $id,
                            'created_at' => Carbon::now(),
                        ]);
                    }

                    $filepath = storage_path('app/public/' . $g->filename);

                    $newfilename = $g->gametitle . ' - ' . $g->gamesubtitle . ' [' . $g->filetype . '-' . $g->fileversion . ']-' . str_pad($g->fileyear, 2, 0, STR_PAD_LEFT)
                        . '-' . str_pad($g->filemonth, 2, 0, STR_PAD_LEFT) . '-' . str_pad($g->fileday, 2, 0, STR_PAD_LEFT) . '.' . $g->fileextension;

                    if (\Auth::check()) {
                        //Check for existing download Template
                        if (\Auth::user()->settings->download_template != '') {

                            //Replace all stuff for download template
                            $t = \Auth::user()->settings->download_template;
                            $t = str_replace('{title}', $g->gametitle, $t);
                            $t = str_replace('{subtitle}', $g->gamesubtitle, $t);
                            $t = str_replace('{reltype}', $g->filetype, $t);
                            $t = str_replace('{relversion}', $g->fileversion, $t);
                            $t = str_replace('{relyear}', str_pad($g->fileyear, 2, 0, STR_PAD_LEFT), $t);
                            $t = str_replace('{relmonth}', str_pad($g->filemonth, 2, 0, STR_PAD_LEFT), $t);
                            $t = str_replace('{relday}', str_pad($g->fileday, 2, 0, STR_PAD_LEFT), $t);
                            $t = str_replace('{ext}', $g->fileextension, $t);
                            $newfilename = $t;
                        }
                    }

                    return response()->download($filepath, $newfilename);
                }
            } catch(\Exception $exception) {
                $g = \DB::table('games')
                    ->select([
                        'games.id as gameid',
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

                return \Redirect::action('GameController@show', ['id' => $g->gameid]);
            }

        }
    }

    /**
     * Download function for Backup Downloads without download counter
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download_wo_count(Request $request)
    {
        $filepath = storage_path('app/public/'.$request->get('filename'));

        $newfilename = $request->get('id');

        return response()->download($filepath, $newfilename);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($id)
    {
        $gamefiles = GamesFile::whereGameId($id)
            ->orderBy('release_year', 'desc')
            ->orderBy('release_month', 'desc')
            ->orderBy('release_day', 'desc')
            ->get();
        $game = Game::whereId($id)->first();
        $filetypes = GamesFilesType::get();

        return view('games.gamefiles', [
            'gamefiles' => $gamefiles,
            'game'      => $game,
            'filetypes' => $filetypes,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'uuid'              => 'required',
            'version'           => 'required',
            'releasedate_day'   => 'required|not_in:0',
            'releasedate_month' => 'required|not_in:0',
            'releasedate_year'  => 'required|not_in:0',
            'filetype'          => 'required|not_in:0',
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
                'game_id'         => $id,
                'filesize'        => $meta['size'],
                'extension'       => $meta['ext'],
                'release_type'    => $request->get('filetype'),
                'release_version' => $request->get('version'),
                'release_day'     => $request->get('releasedate_day'),
                'release_month'   => $request->get('releasedate_month'),
                'release_year'    => $request->get('releasedate_year'),
                'language_id'     => $request->get('language'),
                'user_id'         => \Auth::id(),
                'filename'        => $storagedest,
                'created_at'      => Carbon::now(),
            ]);

            event(new Obyx('gamefile-add', \Auth::id()));
        }

        DatabaseHelper::setReleaseInfos($id);

        return redirect()->route('gamefiles.index', [$id]);
    }

    /**
     * @param $id
     * @param $fileid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $fileid)
    {
        $gf = GamesFile::whereId($fileid)->first();
        \Storage::delete($gf->filename);

        $gf->delete();

        return redirect()->route('gamefiles.index', [$id]);
    }

    /**
     * @param $id
     * @param $gamefileid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id, $gamefileid)
    {
        $gamefile = GamesFile::whereId($gamefileid)->first();
        $filetypes = GamesFilesType::get();

        return view('games.gamefiles_edit', [
            'gamefile'  => $gamefile,
            'filetypes' => $filetypes,
        ]);
    }

    /**
     * @param $gamefileid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($gamefileid)
    {
        $gamefile = GamesFile::whereId($gamefileid)->first();
        $gamefile->forbidden = 0;
        $gamefile->reason = '';
        $gamefile->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @param $gamefileid
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id, $gamefileid)
    {
        $this->validate($request, [
            //'uuid' => 'required',
            'version'           => 'required',
            'releasedate_day'   => 'required|not_in:0',
            'releasedate_month' => 'required|not_in:0',
            'releasedate_year'  => 'required|not_in:0',
            'filetype'          => 'required|not_in:0',
        ]);

        $gamefile = GamesFile::whereId($gamefileid)->first();

        $gamefile->release_version = $request->get('version');
        $gamefile->release_day = $request->get('releasedate_day');
        $gamefile->release_month = $request->get('releasedate_month');
        $gamefile->release_year = $request->get('releasedate_year');
        $gamefile->release_type = $request->get('filetype');
        $gamefile->language_id = $request->get('language');

        if ($request->get('uuid')) {
            //Create Backupfile
            if (\Storage::exists($gamefile->filename)) {
                \Storage::move($gamefile->filename, $gamefile->filename.'-'.time());
            }

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

        if ($request->get('forbidden') && ($request->get('forbidden') != '')) {
            $gamefile->forbidden = 1;
            $gamefile->reason = $request->get('forbidden');
        } else {
            $gamefile->forbidden = 0;
            $gamefile->reason = '';
        }

        $gamefile->save();

        DatabaseHelper::setReleaseInfos($id);

        return redirect()->route('gamefiles.index', [$id]);
    }
}
