<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\Logo;
use App\Models\LogoVote;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function vote_get()
    {
        $logos = [];

        if (\Auth::check()) {
            $logos = \DB::table('logos')
                ->leftJoin('logo_votes', 'logos.id', '=', 'logo_votes.logo_id')
                ->leftJoin('users', 'logos.user_id', '=', 'users.id')
                ->select(['logos.id', 'logos.filename', 'logos.title', 'users.name', 'logos.user_id'])
                ->whereNotExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('logo_votes')
                        ->whereRaw('logo_votes.logo_id = logos.id')
                        ->whereRaw('logo_votes.user_id = '.\Auth::id());
                })
                ->inRandomOrder()
                ->first();
        }

        return view('logo.index', ['logo' => $logos]);
    }

    public function vote_add($id, Request $request)
    {
        $lv = new LogoVote();
        $lv->logo_id = $id;
        $lv->user_id = \Auth::id();
        if ($request->get('value') == 0) {
            $lv->down = 1;
            $lv->up = 0;
        } else {
            $lv->down = 0;
            $lv->up = 1;
        }

        $lv->save();

        event(new Obyx('logo-vote', \Auth::id()));

        return \Redirect::back();
    }
}
