<?php

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\Screenshot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;


class ScreenshotController extends Controller
{
    public function show($gameid, $screenid) {
        $s = Screenshot::whereGameId($gameid)->where('screenshot_id', $screenid)
            ->first();

        $storagePath = '';

        //Prüfen ob Screenshots vorhanden sind
        if (is_null($s)) {//Es sind keine Screenshots vorhanden
            $storagePath = public_path().'/assets/no_image.png';
        }else {//Es sind Screenshots vorhanden
            $storagePath = \Storage::get($s->filename);
        }

        return Image::make($storagePath)->response();
    }

    public function create($gameid, $screenid) {
        return view('screenshots.create', [
            'gameid' => $gameid,
            'screenid' => $screenid,
        ]);
    }

    public function upload(Request $request, $gameid, $screenid) {
        $this->validate($request, [
            'file' => 'required|image|mimes:png|max:2048',
        ]);

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $extorig = $file->getExtension();

        $imageName = \Storage::putFile('screenshots', new UploadedFile($file->path(), $file->getClientOriginalName()));
        //dd($file);

        //Löschen des vorhandenen DB Eintrages
        $old = Screenshot::whereGameId($gameid)->where('screenshot_id', '=', $screenid)->first();
        if ($old) {
            $old->delete();
        }


        //Speichern des Screenshots
        $scr = new Screenshot;
        $scr->game_id = $gameid;
        $scr->user_id = \Auth::id();
        $scr->screenshot_id = $screenid;
        $scr->filename = str_replace($extorig, '', $imageName);
        $scr->save();

        event(new Obyx('screenshot-add', \Auth::id()));

        return redirect()->route('screenshot.upload.success', $gameid);
    }
}
