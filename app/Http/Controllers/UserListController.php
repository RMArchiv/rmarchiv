<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function create()
    {
        return view('users.lists.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'desc'  => 'required',
        ]);

        \DB::table('user_lists')->insert([
            'user_id'    => \Auth::id(),
            'title'      => $request->get('title'),
            'desc_md'    => $request->get('desc'),
            'desc_html'  => \Markdown::convertToHtml($request->get('desc')),
            'created_at' => Carbon::now(),
        ]);

        return \Redirect::back();
    }

    public function delete_game($listid, $itemid)
    {
        \DB::table('user_list_items')
            ->where('list_id', '=', $listid)
            ->where('content_id', '=', $itemid)
            ->where('content_type', '=', 'game')
            ->delete();

        return \Redirect::back();
    }

    public function delete($listid)
    {
        if (\Auth::check()) {
            if (\Auth::user()->hasRole('admin')) {
                \DB::table('user_list_items')
                    ->where('list_id', '=', $listid)
                    ->delete();

                \DB::table('user_lists')
                    ->where('id', '=', $listid)
                    ->delete();
            } else {
                $list = \DB::table('user_lists')
                    ->where('id', '=', $listid)
                    ->where('user_id', '=', \Auth::id())
                    ->get();

                if ($list->count() != 0) {
                    \DB::table('user_lists')
                        ->where('id', '=', $listid)
                        ->delete();

                    \DB::table('user_list_items')
                        ->where('list_id', '=', $listid)
                        ->delete();
                }
            }
        }

        return \Redirect::back();
    }

    public function add_game(Request $request, $listid, $gameid)
    {
        if (\Auth::check()) {
            $check = \DB::table('user_list_items')
                ->where('content_id', '=', $gameid)
                ->where('content_type', '=', 'game')
                ->where('list_id', '=', $listid)
                ->get();
            if ($check->count() == 0) {
                \DB::table('user_list_items')->insert([
                    'content_id'   => $gameid,
                    'content_type' => 'game',
                    'user_id'      => \Auth::id(),
                    'list_id'      => $listid,
                    'created_at'   => Carbon::now(),
                ]);
            }
        }

        return \Redirect::action('GameController@show', $gameid);
    }

    public function show($userid, $listid)
    {
        $list = \DB::table('user_lists')
            ->leftJoin('users', 'users.id', '=', 'user_lists.user_id')
            ->where('user_lists.id', '=', $listid)
            ->first();

        $games = \DB::table('user_list_items')
            ->leftJoin('games', 'games.id', '=', 'user_list_items.content_id')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('comments', function ($join) {
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
            ->where('user_list_items.list_id', '=', $listid)
            ->where('user_list_items.content_type', '=', 'game')
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

        return view('users.lists.show', [
            'games'     => $games,
            'gametypes' => $gtypes,
            'maxviews'  => DatabaseHelper::getGameViewsMax(),
            'list'      => $list,
        ]);
    }

    public function index($userid)
    {
        $lists = \DB::table('user_lists')
            ->where('user_id', '=', $userid)
            ->select([
                'id',
                'title',
                'user_id',
                'created_at',
            ])
            ->selectRaw('(SELECT COUNT(*) FROM user_list_items WHERE list_id = user_lists.id) as count')
            ->orderBy('title')
            ->get();

        return view('users.lists.index', [
            'lists' => $lists,
        ]);
    }
}
