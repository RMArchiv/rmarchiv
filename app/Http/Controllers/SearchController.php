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
    public function index($orderby = 'title', $direction = 'asc', $query = '')
    {
        if ($query == '') {
            return view('search.index');
        } else {
            $rows = (\Auth::check()) ? \Auth::user()->settings->rows_per_page_games : config('app.rows_per_page_games');

            $games = Game::search($query)->orderBy($orderby, $direction)->paginate($rows);

            return view('search.index', [
                'games'     => $games,
                'maxviews'  => DatabaseHelper::getGameViewsMax(),
                'term' => $query,
                'orderby' => $orderby,
                'direction' => $direction,
            ]);
        }
    }

    public function search(Request $request, $orderby = 'title', $direction = 'asc')
    {
        return redirect()->action('SearchController@index', [
            $orderby, $direction, $request->get('term'),
        ]);
    }
}
