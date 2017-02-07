<?php

namespace App\Http\Controllers;

use App\Models\Tag;
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

    public function showGames($tagid)
    {
        $games = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('tag_relations', function ($join) {
                $join->on('tag_relations.content_id', '=', 'games.id');
                $join->on('tag_relations.content_type', '=', \DB::raw("'game'"));
            })
            ->leftJoin('tags', 'tag_relations.tag_id', '=', 'tags.id')
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
                'games.views as views',
                'tags.title as tag',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->where('tags.id', '=', $tagid)
            ->orderBy('games.title')
            ->groupBy('games.id')
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

        return view('tags.show', [
            'games'     => $games,
            'gametypes' => $gtypes,
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

    public function delete_gametag($gameid, $tagid){
        $tag = TagRelation::whereContentId($gameid)->where('content_type', '=', 'game')->where('tag_id', '=', $tagid)->first();
        $tag->delete();

        return redirect()->action('GameController@edit', $gameid);
    }
}
