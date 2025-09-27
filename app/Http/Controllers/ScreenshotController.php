<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\Game;
use App\Models\Screenshot;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;

class ScreenshotController extends Controller
{
    public function show($gameid, $screenid, $full = null)
    {
        $s = Screenshot::whereGameId($gameid)->where('screenshot_id', $screenid)
            ->first();

        //Prüfen ob Screenshots vorhanden sind
        if (!$s) {//Es sind keine Screenshots vorhanden
            $img = Image::read(public_path().'/assets/no_image.png');

            $response = response()->image($img, Format::PNG);
            $response->header('Content-Type', 'image/png');
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $response->setPublic();

            return $response;

        } else {//Es sind Screenshots vorhanden
            $cachePath = implode("/",array("cache",explode("screenshots/", $s->filename)[1]));
            if(!Storage::exists("cache")){
                Storage::makeDirectory("cache");
            }
            if (! $full) {
                if(\Storage::exists($cachePath)) {
                    $img = Image::read(\Storage::get($cachePath));
                    if($img) {
                        return response()->image($img, Format::WEBP);
                    }
                    return response($img, 200, ['Content-Type'=> 'image/webp']);
                }
                else {
                    $result = Image::read(\Storage::get( $s->filename))->toWebp(quality:80);
                    $result->save(Storage::path($cachePath));
                    $img = $result;
                    return response($img, 200, ['Content-Type'=> 'image/webp']);
                }
            } else {
                $response = $response = response()->image(Image::read(\Storage::get( $s->filename)), Format::PNG);
                $response->header('Content-Type', 'image/png');
                return $response;
            }

        }
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
