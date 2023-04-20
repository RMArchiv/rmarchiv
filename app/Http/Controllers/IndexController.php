<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\BoardPost;
use App\Models\Developer;
use App\Models\GamesFile;
use App\Models\Logo;
use App\Models\Maker;
use Carbon\Carbon;
use App\Models\Game;
use App\Models\News;
use App\Models\User;
use App\Models\Comment;
use App\Models\Shoutbox;
use App\Helpers\MiscHelper;
use App\Models\BoardThread;
use App\Models\GamesCoupdecoeur;

class IndexController extends Controller
{
    public function index()
    {
        $gametypes = \DB::table('games_files_types')
            ->select('id', 'title', 'short')
            ->get();
        $gtypes = [];
        foreach ($gametypes as $gt) {
            $t['title'] = $gt->title;
            $t['short'] = $gt->short;
            $gtypes[$gt->id] = $t;
        }

        $news = News::with('user', 'comments')->orderBy('created_at', 'desc')->where('approved', '=', 1)->get()->take(5);
        $shoutbox = Shoutbox::with('user')->orderBy('created_at', 'desc')->limit(5)->get()->reverse();
        $cdc = GamesCoupdecoeur::with('game')->orderBy('created_at', 'desc')->get()->first();
        $threads = BoardThread::with('posts', 'user', 'last_user')->orderBy('last_created_at', 'desc')->limit(10)->get();

        $topusers = \DB::table('users as u')
            ->leftJoin('user_role_user as uru', 'u.id', '=', 'uru.user_id')
            ->leftJoin('user_roles as ur', 'ur.id', '=', 'uru.role_id')
            ->select([
                'u.id as userid',
                'u.name as username',
                'u.created_at as usercreated_at',
                'ur.display_name as rolename',
                'ur.description as roledesc',
            ])
            ->selectRaw('(SELECT SUM(obyx.value) FROM user_obyx LEFT JOIN obyx ON obyx.id = user_obyx.obyx_id WHERE user_obyx.user_id = u.id) as obyx')
            ->orderBy('obyx', 'desc')
            ->limit(10)
            ->get();

        $obyxmax = \DB::table('user_obyx as uo')
            ->leftJoin('obyx as o', 'o.id', '=', 'uo.obyx_id')
            ->selectRaw('SUM(o.value) as value')
            ->groupBy('uo.user_id')
            ->orderByRaw('SUM(o.value) DESC')
            ->first();

        if (\Auth::check()) {
            $pm = \Auth::user()->newThreadsCount();
        } else {
            $pm = '';
        }

        $stats_gamecount = Game::count();
        $stats_makercount = Maker::count();
        $stats_developercount = Developer::count();
        $stats_usercount = User::count();
        $stats_threadcount = BoardThread::count();
        $stats_postcount = BoardPost::count();
        $stats_shoutboxcount = Shoutbox::count();
        $stats_commentcount = Comment::count();
        $stats_logocount = Logo::count();
        $stats_downloadcount = GamesFile::sum('downloadcount');
        $stats_totalsize = GamesFile::sum('filesize');
        $stats_filecount = GamesFile::count();

        $size = \DB::table('games_files')
            ->selectRaw('SUM(filesize * downloadcount) as downsize')
            ->groupBy('id')
            ->get();

        $res = 0;
        foreach ($size as $s) {
            $res += $s->downsize;
        }
        $size = MiscHelper::getReadableBytes($res);

        $latestadded = Game::with('maker', 'gamefiles', 'language', 'developers')->orderBy('created_at', 'desc')->where('games.invisible_on_start_page', '=', 0)->limit(5);
        $latestreleased = Game::where('release_type', '!=', 99)->where('games.invisible_on_start_page', '=', 0)->orderBy('release_date', 'desc')->limit(5);

        $topmonth = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('languages', 'languages.id', '=', 'games.lang_id')
            ->leftJoin('comments', function ($join) {
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
            })
            ->leftJoin('games_files', 'games_files.game_id', '=', 'games.id')
            ->leftJoin('users', 'games_developer.user_id', '=', 'users.id')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'games.invisible_on_start_page as invisible',
                'developer.name as developername',
                'developer.id as developerid',
                'developer.created_at as developerdate',
                'developer.user_id as developeruserid',
                'users.name as developerusername',
                'games.created_at as gamecreated_at',
                'makers.short as makershort',
                'makers.title as makertitle',
                'makers.id as makerid',
                'languages.id as lang_id',
                'languages.name as lang_name',
                'languages.short as lang_short',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->where('comments.created_at', '>', Carbon::today()->addMonth(-1)->toDateString())
            ->where('games.invisible_on_start_page', '=', 0)
            ->orderByRaw('(voteup - votedown) / (voteup + votedown) DESC')
            ->groupBy('games.id')
            ->limit(5);

        $topalltime = Game::orderBy('avg', 'desc')->where('games.invisible_on_start_page', '=', 0)->limit(5);
        $latestcomments = Comment::with('game')->whereContentType('game')->orderBy('created_at', 'desc')->limit(5)->get();
        $randomgame = Game::inRandomOrder()->where('games.invisible_on_start_page', '=', 0);
        if (!\Auth::check()) {
            $randomgame->where('nsfw', '=', false);
            $topmonth->where('nsfw', '=', false);
            $topalltime->where('nsfw', '=', false);
            $latestadded->where('nsfw', '=', false);
            $latestreleased->where('nsfw', '=', false);
        }
        $randomgame = $randomgame->first();
        $topmonth = $topmonth->get();
        $topalltime = $topalltime->get();
        $latestadded = $latestadded->get();
        $latestreleased = $latestreleased->get();

        $newuser = User::orderBy('created_at', 'desc')->first();

        return view('index.index', [
            'news'           => $news,
            'shoutbox'       => $shoutbox,
            'cdc'            => $cdc,
            'latestadded'    => $latestadded,
            'gametypes'      => $gtypes,
            'latestreleased' => $latestreleased,
            'threads'        => $threads,
            'obeymax'        => $obyxmax,
            'topusers'       => $topusers,
            'pm'             => $pm,
            'topmonth'       => $topmonth,
            'topalltime'     => $topalltime,
            'latestcomments' => $latestcomments,
            'size'           => $size,
            'randomgame'     => $randomgame,
            'newuser'        => $newuser,
            'stats_gamecount' => $stats_gamecount,
            'stats_makercount' => $stats_makercount,
            'stats_developercount' => $stats_developercount,
            'stats_usercount' => $stats_usercount,
            'stats_threadcount' => $stats_threadcount,
            'stats_postcount' => $stats_postcount,
            'stats_shoutboxcount' => $stats_shoutboxcount,
            'stats_commentcount' => $stats_commentcount,
            'stats_logocount' => $stats_logocount,
            'stats_downloadcount' => $stats_downloadcount,
            'stats_totalsize' => $stats_totalsize,
            'stats_filecount' => $stats_filecount
        ]);
    }
}
