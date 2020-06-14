<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Game;
use App\Models\TagRelation;
use Illuminate\Http\Request;

class TaggingController extends Controller
{
    public function index($orderby = 'tag', $direction = 'asc')
    {
        $tags = Tag::all()->sortBy('title');

        return view('tags.index', [
            'tags'      => $tags,
            'orderby'   => $orderby,
            'direction' => $direction,
        ]);
    }

    public function showGames($id, $orderby = 'title', $direction = 'asc')
    {
        $tag = Tag::whereId($id)->first();

        if ($orderby == 'developer.name') {
            $games = Game::Join('games_developer', 'games.id', '=', 'games_developer.game_id')
                ->Join('developer', 'games_developer.developer_id', '=', 'developer.id')
                ->Join('tag_relations', 'tag_relations.content_id', '=', 'games.id')
                ->Where('tag_relations.tag_id', '=', $id)
                ->where('tag_relations.content_type', '=', 'game')
                ->orderBy($orderby, $direction)
                ->select('games.*')
                ->paginate(25);
        } else {
            $games = Game::Join('tag_relations', 'tag_relations.content_id', '=', 'games.id')
                ->Where('tag_relations.tag_id', '=', $id)
                ->where('tag_relations.content_type', '=', 'game')
                ->orderBy($orderby, $direction)
                ->orderBy('title')
                ->orderBy('subtitle')
                ->select('games.*')
                ->paginate(25);
        }

        return view('tags.show', [
            'games'     => $games,
            'tag'       => $tag,
            'orderby'   => $orderby,
            'direction' => $direction,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'        => 'required',
            'content_id'   => 'required',
            'content_type' => 'required',
        ]);

        $tag = Tag::firstOrCreate(['title' => $request->get('title')]);
        $tagid = $tag->id;

        TagRelation::firstOrCreate([
            'tag_id'       => $tagid,
            'user_id'      => \Auth::id(),
            'content_id'   => $request->get('content_id'),
            'content_type' => $request->get('content_type'),
        ]);

        if ($request->get('content_type') == 'news') {
            return \Redirect::action('NewsController@show', $request->get('content_id'));
        } elseif ($request->get('content_type') == 'game') {
            return \Redirect::action('GameController@show', $request->get('content_id'));
        } elseif ($request->get('content_type') == 'resource') {
            return \Redirect::action('ResourceController@show', $request->get('content_id'));
        }

        return \Redirect::action('IndexController@index');
    }

    public function delete_gametag($gameid, $tagid)
    {
        $tag = TagRelation::whereContentId($gameid)->where('content_type', '=', 'game')->where('tag_id', '=', $tagid)->first();
        $tag->delete();

        return redirect()->action('GameController@edit', $gameid);
    }
}
