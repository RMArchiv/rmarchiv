<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;


class ScreenshotController extends Controller
{
    public function show($gameid, $screenid){
        $s = \DB::table('screenshots')
            ->select('filename')
            ->where('game_id', '=', $gameid)
            ->where('screenshot_id', '=', $screenid)
            ->first();

        $storagePath = '';

        //Prüfen ob Screenshots vorhanden sind
        if(is_null($s)){//Es sind keine Screenshots vorhanden
            $storagePath = public_path().'/assets/no_image.png';
        }else{//Es sind Screenshots vorhanden
            $storagePath = \Storage::get($s->filename);
        }


        return Image::make($storagePath)->response();
    }

    public function create($gameid, $screenid){
        return view('screenshots.create', [
            'gameid' => $gameid,
            'screenid' => $screenid,
        ]);
    }

    public function upload(Request $request, $gameid, $screenid){
        $this->validate($request, [
            'file' => 'required|image|mimes:png|max:2048',
        ]);

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $extorig = $file->getExtension();

        $imageName = \Storage::putFile('screenshots', new UploadedFile($file->path(), $file->getClientOriginalName()));
        //dd($file);

        $s = \DB::table('screenshots')->insert([
            'game_id' => $gameid,
            'user_id' => \Auth::id(),
            'screenshot_id' => $screenid,
            'created_at' => Carbon::now(),
            'filename' => str_replace($extorig, '', $imageName),
        ]);

        return redirect()->route('screenshot.upload.success', $gameid);
    }
}
