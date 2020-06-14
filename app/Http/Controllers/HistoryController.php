<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Game;
use Spatie\Activitylog\Models\Activity;

class HistoryController extends Controller
{
    public function index($id)
    {
        $a = Activity::all()->where('subject_type', '=', 'App\Models\Game')
            ->where('subject_id', '=', $id);

        $game = Game::whereId($id)->first();

        return view('history.index_game', [
            'activity' => $a,
            'game'     => $game,
        ]);
    }
}
