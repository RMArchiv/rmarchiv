<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\UserList;
use App\Models\UserListItem;
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

    public function add_game($listid, $gameid)
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
        $list = UserList::whereId($listid)->first();
        $arr = UserListItem::whereListId($listid)->pluck('content_id')->toArray();
        $games = Game::find($arr);

        return view('users.lists.show', [
            'list'      => $list,
            'games'     => $games,
            'orderby'   => '',
            'direction' => '',
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
