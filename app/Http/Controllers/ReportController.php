<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\UserReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $r = UserReport::all();

        return view('reports.index', [
            'reports' => $r,
        ]);
    }

    public function create_game_report($gameid)
    {
        $g = Game::whereId($gameid)->first();

        return view('reports.create', [
            'game' => $g,
        ]);
    }

    public function store_game_report(Request $request, $gameid)
    {
        $r = new UserReport;
        $r->content_id = $gameid;
        $r->content_type = 'game';
        $r->reason = $request->get('msg');
        $r->user_id = \Auth::id();
        $r->save();

        return redirect()->action('ReportController@index_user');
    }

    public function index_user()
    {
        if (\Auth::check()) {
            if (\Auth::user()->can('admin-games')) {
                $ur = UserReport::all();
            } else {
                $ur = UserReport::whereUserId(\Auth::id());
            }
        } else {
            $ur = null;
        }

        return view('reports.index', [
            'reports' => $ur,
        ]);
    }

    public function close_ticket($id)
    {
        $t = UserReport::whereId($id)->first();
        $t->closed = 1;
        $t->closed_at = Carbon::now();
        $t->closed_user_id = \Auth::id();
        $t->save();

        return redirect()->action('ReportController@index_user');
    }

    public function open_ticket($id)
    {
        $t = UserReport::whereId($id)->first();
        $t->closed = 0;
        $t->closed_at = Carbon::now();
        $t->closed_user_id = \Auth::id();
        $t->save();

        return redirect()->action('ReportController@index_user');
    }

    public function remark_ticket($id)
    {
    }
}
