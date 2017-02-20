<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseHelper;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        return view('search.index');
    }

    public function search(Request $request){
        $games = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function($join){
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
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
            ->selectRaw('(SELECT (voteup - votedown) / (voteup + votedown)) as avg')
            ->where('games.title', 'like', '%'.$request->get('term').'%')
            ->orWhere('games.subtitle', 'like', '%'.$request->get('term').'%')
            ->orWhere('developer.name', 'like', '%'.$request->get('term').'%')
            ->groupBy('games.id')
            ->orderBy('gametitle')
            ->orderBy('gamesubtitle')
            ->paginate(20);


        $gametypes = \DB::table('games_files_types')
            ->select('id', 'title', 'short')
            ->get();
        $gtypes = array();
        foreach ($gametypes as $gt){
            $t['title'] = $gt->title;
            $t['short'] = $gt->short;
            $gtypes[$gt->id] = $t;
        }

        return view('search.index', [
            'games' => $games,
            'gametypes' => $gtypes,
            'maxviews' => DatabaseHelper::getGameViewsMax(),
            'term' => $request->get('term'),
        ]);

    }
}
