<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Helpers\DatabaseHelper;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function search(Request $request)
    {
        $rows = (\Auth::check()) ? \Auth::user()->settings->rows_per_page_games : config('app.rows_per_page_games');

        dd($rows);

        $games = Game::search($request->get('term'))->orderBy('title', 'asc')->orderBy('title')->orderBy('subtitle')->get($rows);

        return view('games.index', [
            'games'     => $games,
            'maxviews'  => DatabaseHelper::getGameViewsMax(),
            'term' => $request->get('term'),
        ]);
    }
}
