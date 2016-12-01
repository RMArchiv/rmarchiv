<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $gametypes = \DB::table('games_files_types')
            ->select('id', 'title', 'short')
            ->get();
        $gtypes = array();
        foreach ($gametypes as $gt){
            $t['title'] = $gt->title;
            $t['short'] = $gt->short;
            $gtypes[$gt->id] = $t;
        }

        $news = \DB::table('news')
            ->leftJoin('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('comments', function($join){
                $join->on('comments.content_id', '=', 'news.id');
                $join->on('comments.content_type', '=', \DB::raw("'news'"));
            })
            ->select(['news.id', 'news.title', 'news.user_id', 'users.name', 'news.created_at', 'news.approved', 'news.news_html'])
            ->selectRaw('COUNT(comments.id) as counter')
            ->orderBy('news.created_at', 'desc')
            ->groupBy('news.id')
            ->get()->take(5);

        $shoutbox = \DB::table('shoutbox')
            ->select([
                'users.id as userid',
                'users.name as username',
                'shoutbox.shout_html as shouthtml',
                'shoutbox.created_at as shoutcreated_at'
            ])
            ->leftJoin('users', 'shoutbox.user_id', '=', 'users.id')
            ->orderBy('shoutbox.created_at', 'desc')
            ->limit(5)
            ->get()
            ->reverse();

        $cdc = \DB::table('games_coupdecoeur')
            ->leftJoin('games', 'games.id', '=', 'games_coupdecoeur.game_id')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function($join){
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
            })
            ->leftJoin('games_files', 'games_files.game_id', '=', 'games.id')
            ->leftJoin('users', 'games_developer.user_id', '=', 'users.id')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'developer.name as developername',
                'developer.id as developerid',
                'developer.created_at as developerdate',
                'developer.user_id as developeruserid',
                'users.name as developerusername',
                'games.created_at as gamecreated_at',
                'makers.short as makershort',
                'makers.title as makertitle',
                'makers.id as makerid',
                'games_coupdecoeur.created_at as cdcdate',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->groupBy('games.id')
            ->orderBy('games_coupdecoeur.created_at', 'desc')
            ->first();

        $latestadded = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function($join){
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
            })
            ->leftJoin('games_files', 'games_files.game_id', '=', 'games.id')
            ->leftJoin('users', 'games_developer.user_id', '=', 'users.id')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'developer.name as developername',
                'developer.id as developerid',
                'developer.created_at as developerdate',
                'developer.user_id as developeruserid',
                'users.name as developerusername',
                'games.created_at as gamecreated_at',
                'makers.short as makershort',
                'makers.title as makertitle',
                'makers.id as makerid',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->orderBy('games.created_at', 'desc')
            ->groupBy('games.id')
            ->limit(5)->get();

        $latestreleased = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function($join){
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
            })
            ->leftJoin('games_files', 'games_files.game_id', '=', 'games.id')
            ->leftJoin('users', 'games_developer.user_id', '=', 'users.id')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'developer.name as developername',
                'developer.id as developerid',
                'developer.created_at as developerdate',
                'developer.user_id as developeruserid',
                'users.name as developerusername',
                'games.created_at as gamecreated_at',
                'makers.short as makershort',
                'makers.title as makertitle',
                'makers.id as makerid',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->orderBy('games_files.release_year', 'desc')
            ->orderBy('games_files.release_month', 'desc')
            ->orderBy('games_files.release_day', 'desc')
            ->groupBy('games.id')
            ->limit(5)->get();

        $threads = \DB::table('board_threads as t')
            ->leftJoin('users as u', 't.user_id', '=', 'u.id')
            ->leftJoin('users as lu', 't.last_user_id', '=', 'u.id')
            ->leftJoin('board_cats as c', 'c.id', '=', 't.cat_id')
            ->select([
                'u.id as uid',
                'u.name as uname',
                'c.id as cid',
                'c.title as ctitle',
                't.id as tid',
                't.title as ttitle',
                'lu.id as luid',
                'lu.name as luname'
            ])
            ->selectRaw('(SELECT COUNT(id) FROM board_posts WHERE thread_id = t.id) as pcount')
            ->groupBy('t.id')
            ->orderBy('t.last_created_at', 'desc')
            ->limit(10)
            ->get();

        return view('index.index', [
            'news' => $news,
            'shoutbox' => $shoutbox,
            'cdc' => $cdc,
            'latestadded' => $latestadded,
            'gametypes' => $gtypes,
            'latestreleased' => $latestreleased,
            'threads' => $threads,
        ]);
    }
}
