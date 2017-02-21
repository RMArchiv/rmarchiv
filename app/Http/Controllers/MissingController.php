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
    public function index_gamescreens()
    {
        $games = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function ($join) {
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
            })
            ->leftJoin('screenshots', function ($join) {
                $join->on('screenshots.game_id', '=', 'games.id');
                $join->on('screenshots.screenshot_id', '=', \DB::raw('1'));
            })
            ->leftJoin('games_files', 'games_files.game_id', '=', 'games.id')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'developer.name as developername',
                'developer.id as developerid',
                'games.created_at as gamecreated_at',
                'makers.short as makershort',
                'makers.title as makertitle',
                'makers.id as makerid',
                'games.views as views',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->whereNull('screenshots.id')
            ->groupBy('games.id')
            ->orderBy('gametitle')
            ->orderBy('gamesubtitle')
            ->get();

        $gametypes = \DB::table('games_files_types')
            ->select('id', 'title', 'short')
            ->get();
        $gtypes = [];
        foreach ($gametypes as $gt) {
            $t['title'] = $gt->title;
            $t['short'] = $gt->short;
            $gtypes[$gt->id] = $t;
        }

        return view('missing.gamescreens.index', [
            'games' => $games,
            'gametypes' => $gtypes,
            'maxviews' => DatabaseHelper::getGameViewsMax(),
        ]);
    }

    //Spiele mit fehlenden Spieledateien anzeigen
    public function index_gamefiles()
    {
        $games = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function ($join) {
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
            })
            ->leftJoin('screenshots', function ($join) {
                $join->on('screenshots.game_id', '=', 'games.id');
                $join->on('screenshots.screenshot_id', '=', \DB::raw('1'));
            })
            ->leftJoin('games_files', 'games_files.game_id', '=', 'games.id')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'developer.name as developername',
                'developer.id as developerid',
                'games.created_at as gamecreated_at',
                'makers.short as makershort',
                'makers.title as makertitle',
                'makers.id as makerid',
                'games.views as views',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->whereNull('games_files.id')
            ->groupBy('games.id')
            ->orderBy('gametitle')
            ->orderBy('gamesubtitle')
            ->get();

        $gametypes = \DB::table('games_files_types')
            ->select('id', 'title', 'short')
            ->get();
        $gtypes = [];
        foreach ($gametypes as $gt) {
            $t['title'] = $gt->title;
            $t['short'] = $gt->short;
            $gtypes[$gt->id] = $t;
        }

        return view('missing.gamefiles.index', [
            'games' => $games,
            'gametypes' => $gtypes,
            'maxviews' => DatabaseHelper::getGameViewsMax(),
        ]);
    }

    //Spiele mit fehlender Spielebeschreibung anzeigen
    public function index_gamedesc()
    {
        $games = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function ($join) {
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
            })
            ->leftJoin('screenshots', function ($join) {
                $join->on('screenshots.game_id', '=', 'games.id');
                $join->on('screenshots.screenshot_id', '=', \DB::raw('1'));
            })
            ->leftJoin('games_files', 'games_files.game_id', '=', 'games.id')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'developer.name as developername',
                'developer.id as developerid',
                'games.created_at as gamecreated_at',
                'makers.short as makershort',
                'makers.title as makertitle',
                'makers.id as makerid',
                'games.views as views',
                'games.desc_md as gamedesc',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->where('games.desc_md', '=', '')
            ->groupBy('games.id')
            ->orderBy('gametitle')
            ->orderBy('gamesubtitle')
            ->get();

        $gametypes = \DB::table('games_files_types')
            ->select('id', 'title', 'short')
            ->get();
        $gtypes = [];
        foreach ($gametypes as $gt) {
            $t['title'] = $gt->title;
            $t['short'] = $gt->short;
            $gtypes[$gt->id] = $t;
        }

        return view('missing.gamedesc.index', [
            'games' => $games,
            'gametypes' => $gtypes,
            'maxviews' => DatabaseHelper::getGameViewsMax(),
        ]);
    }
}
