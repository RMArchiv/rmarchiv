<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\Game;
use App\Models\Screenshot;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class ScreenshotController extends Controller
{
    public function show($gameid, $screenid, $full = null)
    {
        $s = Screenshot::whereGameId($gameid)->where('screenshot_id', $screenid)
            ->first();

        //Prüfen ob Screenshots vorhanden sind
        if (!$s) {//Es sind keine Screenshots vorhanden
            $storagePath = public_path().'/assets/no_image.png';
        } else {//Es sind Screenshots vorhanden
            $storagePath = \Storage::get($s->filename);
        }

        $img = \Image::make($storagePath);
        if (! $full) {
            $response = \Response::make($img->encode('jpg', 80));
            $response->header('Content-Type', 'image/jpg');
        } else {
            $response = \Response::make($img->encode('png'));
            $response->header('Content-Type', 'image/png');
        }
        //$response->setMaxAge(604800);
        //$etag = md5($s->id.'-'.$s->updated_at);
        //$response->setEtag($etag);
        //$response->setLastModified($s->updated_at);
        $response->setPublic();

        return $response;

        //return Image::make($storagePath)->response();
    }

    public function create($gameid, $screenid)
    {
        if (\Auth::check()) {
            $game = Game::whereId($gameid)->first();

            return view('screenshots.create', [
                'gameid'   => $gameid,
                'screenid' => $screenid,
                'game'     => $game,
            ]);
        } else {
            return redirect()->back();
        }
    }

    public function upload(Request $request, $gameid, $screenid)
    {
        if (\Auth::check()) {
            $this->validate($request, [
                'file' => 'required|image|mimes:png|max:2048',
            ]);

            $file = $request->file('file');
            $extorig = $file->getExtension();

            $imageName = \Storage::putFile('screenshots', new UploadedFile($file->path(), $file->getClientOriginalName()));
            //dd($file);

            //Löschen des vorhandenen DB Eintrages
            $old = Screenshot::whereGameId($gameid)->where('screenshot_id', '=', $screenid)->first();
            if ($old) {
                $old->delete();
            } else {
                event(new Obyx('screenshot-add', \Auth::id()));
            }

            //Speichern des Screenshots
            $scr = new Screenshot();
            $scr->game_id = $gameid;
            $scr->user_id = \Auth::id();
            $scr->screenshot_id = $screenid;
            $scr->filename = str_replace($extorig, '', $imageName);
            $scr->save();

            return redirect()->route('screenshot.upload.success', $gameid);
        } else {
            return redirect()->back();
        }
    }
}
