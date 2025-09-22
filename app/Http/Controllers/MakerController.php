<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Maker;

class MakerController extends Controller
{
    public function index($orderby = 'title', $direction = 'asc')
    {
        $makers = Maker::orderBy($orderby, $direction)
            ->paginate(25);

        return view('maker.index', [
            'makers'    => $makers,
            'orderby'   => $orderby,
            'direction' => $direction,
        ]);
    }

    public function show($makerid, $orderby = 'title', $direction = 'asc')
    {
        $games = Game::where('maker_id', '=', $makerid)
            ->join('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->join('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->select(['games.id','comments','games.title','games.subtitle','games.release_date','games.created_at','voteup','votedown','avg', 'maker_id', 'lang_id'])
            ->orderBy($orderby, $direction)
            ->paginate(20);

        $maker = Maker::whereId($makerid)->first();

        return view('maker.show', [
            'games'     => $games,
            'maker'     => $maker,
            'orderby'   => $orderby,
            'direction' => $direction,
            'id'        => $makerid,
        ]);
    }
}
