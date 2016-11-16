<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Optimus\FineuploaderServer\Config\Config;
use Optimus\FineuploaderServer\Storage\LocalStorage;
use Optimus\FineuploaderServer\Storage\StorageInterface;
use Optimus\FineuploaderServer\Uploader;
use Optimus\FineuploaderServer\Vendor\FineUploader;

class GameFileController extends Controller
{
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
            ])
            ->leftJoin('games_files_types', 'games_files.release_type', '=', 'games_files_types.id')
            ->leftJoin('users', 'games_files.user_id', '=', 'users.id')
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

    public function upload(Request $request, $id){

        $uploaddir = storage_path();

        $file = new FineUploader();
        $file->handleUpload($uploaddir, 'file');

        return json_encode($file);
    }

    public function store(Request $request, $id){

        dd($request);
/*
        \DB::table('games_files')->insert([

        ]);

        $l = new Logo;
        $l->extension = \Storage::mimeType($imageName);
        $l->filename = str_replace($extorig, '', $imageName);
        $l->title = $request->get('logoname');
        $l->user_id = \Auth::id();


        $l->save();
*/
    }

    public function destroy(Request $request, $id){

    }
}
