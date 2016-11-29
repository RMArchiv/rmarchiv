<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;


class ScreenshotController extends Controller
{
    public function show($gameid, $screenid){
        $s = \DB::table('screenshots')
            ->where('game_id', '=', $gameid)
            ->where('screenshot_id', '=', $screenid)
            ->get();

        $storagePath = '';

        //Prüfen ob Screenshots vorhanden sind
        if($s){//Es sind keine Screenshots vorhanden
            $storagePath = public_path().'/assets/no_image.png';
        }else{//Es sind Screenshots vorhanden
            $storagePath = \Storage::get('screenshots/'.$gameid.'.'.$screenid.'.png');
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

        $l = new Logo;
        $l->extension = \Storage::mimeType($imageName);
        $l->filename = str_replace($extorig, '', $imageName);
        $l->title = $request->get('logoname');
        $l->user_id = \Auth::id();


        $l->save();

        return redirect()->route('submit.logo.success');
    }
}
