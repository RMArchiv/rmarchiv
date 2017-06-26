<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Game;
use App\Helpers\DatabaseHelper;

class MissingController extends Controller
{
    //Spiele mit fehlenden Tags
    public function index_notags($orderby = 'title', $direction = 'asc')
    {
        $rows = (\Auth::check()) ? \Auth::user()->settings->rows_per_page_games : config('app.rows_per_page_games');

        if ($orderby == 'developer.name') {
            $games = Game::Join('games_developer', 'games.id', '=', 'games_developer.game_id')
                ->Join('developer', 'games_developer.developer_id', '=', 'developer.id')
                ->leftJoin('tag_relations as tr', function ($join) {
                    $join->on('tr.content_id', '=', 'games.id');
                    $join->on('tr.content_type', '=', \DB::raw("'game'"));
                })
                ->groupBy('games.id')
                ->groupBy('tr.tag_id')
                ->orderBy($orderby, $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        } elseif ($orderby == 'game.release_date') {
            $games = Game::Join('games_files', 'games.id', '=', 'games_files.game_id')
                ->leftJoin('tag_relations as tr', function ($join) {
                    $join->on('tr.content_id', '=', 'games.id');
                    $join->on('tr.content_type', '=', \DB::raw("'game'"));
                })
                ->groupBy('games.id')
                ->groupBy('tr.tag_id')
                ->orderBy('games_files.release_year', $direction)
                ->orderBy('games_files.release_month', $direction)
                ->orderBy('games_files.release_day', $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        } else {
            $games = Game::with(['tags'])->select(['games.*', \DB::raw('COUNT(tr.id) as ctr')])
                ->leftJoin('tag_relations as tr', function ($join) {
                    $join->on('tr.content_id', '=', 'games.id');
                    $join->on('tr.content_type', '=', \DB::raw("'game'"));
                })
                ->groupBy('games.id')
                ->groupBy('tr.tag_id')
                ->orderBy($orderby, $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        }

        return view('missing.notags.index', [
            'games' => $games,
            'orderby' => $orderby,
            'direction' => $direction,
        ]);
    }

    //Spiele mit fehlenden Screenshots anzeigen
    public function index_gamescreens($orderby = 'title', $direction = 'asc')
    {
        $rows = (\Auth::check()) ? \Auth::user()->settings->rows_per_page_games : config('app.rows_per_page_games');

        if ($orderby == 'developer.name') {
            $games = Game::Join('games_developer', 'games.id', '=', 'games_developer.game_id')
                ->Join('developer', 'games_developer.developer_id', '=', 'developer.id')
                ->leftJoin('screenshots as tr', 'tr.game_id', '=', 'games.id')
                ->groupBy('games.id')
                ->orderBy($orderby, $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        } elseif ($orderby == 'game.release_date') {
            $games = Game::Join('games_files', 'games.id', '=', 'games_files.game_id')
                ->leftJoin('screenshots as tr', 'tr.game_id', '=', 'games.id')
                ->groupBy('games.id')
                ->orderBy('games_files.release_year', $direction)
                ->orderBy('games_files.release_month', $direction)
                ->orderBy('games_files.release_day', $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        } else {
            $games = Game::with(['tags'])->select(['games.*', \DB::raw('COUNT(tr.id) as ctr')])
                ->leftJoin('screenshots as tr', 'tr.game_id', '=', 'games.id')
                ->groupBy('games.id')
                ->orderBy($orderby, $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        }

        return view('missing.gamescreens.index', [
            'games'     => $games,
            'orderby'   => $orderby,
            'direction' => $direction,
        ]);
    }

    //Spiele mit fehlenden Spieledateien anzeigen
    public function index_gamefiles($orderby = 'title', $direction = 'asc')
    {
        $rows = (\Auth::check()) ? \Auth::user()->settings->rows_per_page_games : config('app.rows_per_page_games');

        if ($orderby == 'developer.name') {
            $games = Game::Join('games_developer', 'games.id', '=', 'games_developer.game_id')
                ->leftJoin('games_files as tr', 'tr.game_id', '=', 'games.id')
                ->leftJoin('screenshots as tr', 'tr.game_id', '=', 'games.id')
                ->groupBy('games.id')
                ->orderBy($orderby, $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        } elseif ($orderby == 'game.release_date') {
            $games = Game::Join('games_files', 'games.id', '=', 'games_files.game_id')
                ->leftJoin('games_files as tr', 'tr.game_id', '=', 'games.id')
                ->groupBy('games.id')
                ->orderBy('games_files.release_year', $direction)
                ->orderBy('games_files.release_month', $direction)
                ->orderBy('games_files.release_day', $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        } else {
            $games = Game::with(['tags'])->select(['games.*', \DB::raw('COUNT(tr.id) as ctr')])
                ->leftJoin('games_files as tr', 'tr.game_id', '=', 'games.id')
                ->groupBy('games.id')
                ->orderBy($orderby, $direction)
                ->havingRaw('COUNT(tr.id) < 1')
                ->paginate($rows, [
                    'games.*',
                ]);
        }

        return view('missing.gamefiles.index', [
            'games'     => $games,
            'orderby'   => $orderby,
            'direction' => $direction,
        ]);
    }

    //Spiele mit fehlender Spielebeschreibung anzeigen
    public function index_gamedesc($orderby = 'title', $direction = 'asc')
    {
        $rows = (\Auth::check()) ? \Auth::user()->settings->rows_per_page_games : config('app.rows_per_page_games');

        if ($orderby == 'developer.name') {
            $games = Game::Join('games_developer', 'games.id', '=', 'games_developer.game_id')
                ->where('games.desc_md', '=', '')
                ->groupBy('games.id')
                ->orderBy($orderby, $direction)
                ->paginate($rows, [
                    'games.*',
                ]);
        } elseif ($orderby == 'game.release_date') {
            $games = Game::Join('games_files', 'games.id', '=', 'games_files.game_id')
                ->where('games.desc_md', '=', '')
                ->groupBy('games.id')
                ->orderBy('games_files.release_year', $direction)
                ->orderBy('games_files.release_month', $direction)
                ->orderBy('games_files.release_day', $direction)
                ->paginate($rows, [
                    'games.*',
                ]);
        } else {
            $games = Game::with(['tags'])->select(['games.*'])
                ->where('games.desc_md', '=', '')
                ->groupBy('games.id')
                ->orderBy($orderby, $direction)
                ->paginate($rows, [
                    'games.*',
                ]);
        }

        return view('missing.gamedesc.index', [
            'games'     => $games,
            'orderby'   => $orderby,
            'direction' => $direction,
        ]);
    }
}
