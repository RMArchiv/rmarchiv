<?php

namespace App\Http\Controllers;

use App\Helpers\MiscHelper;
use App\Models\BoardThread;
use App\Models\Comment;
use App\Models\Game;
use App\Models\GamesCoupdecoeur;
use App\Models\News;
use App\Models\Shoutbox;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $gametypes = \DB::table('games_files_types')
            ->select('id', 'title', 'short')
            ->get();
        $gtypes = array();
        foreach ($gametypes as $gt) {
            $t['title'] = $gt->title;
            $t['short'] = $gt->short;
            $gtypes[$gt->id] = $t;
        }

        $news = News::with('user', 'comments')->orderBy('created_at', 'desc')->where('approved', '=', 1)->get()->take(5);
        $shoutbox = Shoutbox::with('user')->orderBy('created_at', 'desc')->limit(5)->get()->reverse();
        $cdc = GamesCoupdecoeur::with('game')->orderBy('created_at', 'desc')->get()->first();
        $latestadded = Game::with('maker', 'gamefiles', 'language', 'developers')->orderBy('created_at', 'desc')->limit(5)->get();

        $latestreleased = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function($join) {
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

        $threads = BoardThread::with('posts', 'user', 'last_user')->orderBy('last_created_at', 'desc')->limit(10)->get();

        $topusers = \DB::table('users as u')
            ->leftJoin('user_role_user as uru', 'u.id', '=', 'uru.user_id')
            ->leftJoin('user_roles as ur', 'ur.id', '=', 'uru.role_id')
            ->select([
                'u.id as userid',
                'u.name as username',
                'u.created_at as usercreated_at',
                'ur.display_name as rolename',
                'ur.description as roledesc'
            ])
            ->selectRaw('(SELECT SUM(obyx.value) FROM user_obyx LEFT JOIN obyx ON obyx.id = user_obyx.obyx_id WHERE user_obyx.user_id = u.id) as obyx')
            ->orderBy('obyx', 'desc')
            ->limit(5)
            ->get();

        $obyxmax = \DB::table('user_obyx as uo')
            ->leftJoin('obyx as o', 'o.id', '=', 'uo.obyx_id')
            ->selectRaw('SUM(o.value) as value')
            ->groupBy('uo.user_id')
            ->orderByRaw('SUM(o.value) DESC')
            ->first();

        if (\Auth::check()) {
            $pm = \Auth::user()->newThreadsCount();
        }else {
            $pm = '';
        }

        $stats = \DB::table('games')
            ->selectRaw('COUNT(id) as gamecount')
            ->selectRaw('(SELECT COUNT(id) FROM makers) as makercount')
            ->selectRaw('(SELECT COUNT(id) FROM developer) as developercount')
            ->selectRaw('(SELECT COUNT(id) FROM users) as usercount')
            ->selectRaw('(SELECT COUNT(id) FROM board_threads) as threadcount')
            ->selectRaw('(SELECT COUNT(id) FROM board_posts) as postcount')
            ->selectRaw('(SELECT COUNT(id) FROM shoutbox) as shoutboxcount')
            ->selectRAW('(SELECT COUNT(id) FROM comments) as commentcount')
            ->selectRaw('(SELECT COUNT(id) FROM logos) as logocount')
            ->selectRaw('(SELECT SUM(downloadcount) FROM games_files) as downloadcount')
            ->selectRaw('(SELECT SUM(filesize) FROM games_files) as totalsize')
            ->selectRaw('(SELECT COUNT(id) FROM games_files) as filecount')
            ->first();

        $size = \DB::table('games_files')
            ->selectRaw('SUM(filesize * downloadcount) as downsize')
            ->groupBy('id')
            ->get();

        $res = 0;
        foreach ($size as $s) {
            $res += $s->downsize;
        }
        $size = MiscHelper::getReadableBytes($res);

        $topmonth = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function($join) {
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
            ->where('comments.created_at', '>', Carbon::today()->addMonth(-1)->toDateString())
            ->orderByRaw('(voteup - votedown) / (voteup + votedown) DESC')
            ->groupBy('games.id')
            ->limit(5)->get();

        $topalltime = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function($join) {
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
            ->orderByRaw('(voteup - votedown) / (voteup + votedown) DESC')
            ->groupBy('games.id')
            ->limit(5)->get();

        $latestcomments = Comment::with('game')->whereContentType('game')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('index.index', [
            'news' => $news,
            'shoutbox' => $shoutbox,
            'cdc' => $cdc,
            'latestadded' => $latestadded,
            'gametypes' => $gtypes,
            'latestreleased' => $latestreleased,
            'threads' => $threads,
            'obeymax' => $obyxmax,
            'topusers' => $topusers,
            'pm' => $pm,
            'stats' => $stats,
            'topmonth' => $topmonth,
            'topalltime' => $topalltime,
            'latestcomments' => $latestcomments,
            'size' => $size,
        ]);
    }
}
