<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $r = UserReport::all();

        return view('reports.index', [
            'reports' => $r,
        ]);
    }

    public function create_game_report($gameid){
        $g = Game::whereId($gameid)->first();

        return view('reports.create', [
            'game' => $g,
        ]);
    }

    public function store_game_report(Request $request, $gameid){
        $r = new UserReport;
        $r->content_id = $gameid;
        $r->content_type = 'game';
        $r->reason = $request->get('msg');
        $r->user_id = \Auth::id();
        $r->save();

        return redirect()->action('ReportController@index_user', [\Auth::id()]);
    }

    public function index_user($userid){
        $ur = UserReport::whereUserId($userid);

        return view('reports.index_user', [
            'reports' => $ur,
        ]);
    }
}
