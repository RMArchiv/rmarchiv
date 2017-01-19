<?php

namespace App\Http\Controllers;

use App\Events\GameView;
use App\Events\Obyx;
use App\Helpers\DatabaseHelper;
use App\Models\Comment;
use App\Models\Game;
use App\Models\GamesDeveloper;
use App\Models\GamesFile;
use App\Models\Language;
use App\Models\Screenshot;
use App\Models\TagRelation;
use Carbon\Carbon;
use Doctrine\DBAL\Driver\IBMDB2\DB2Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($orderby = 'gametitle', $direction = 'asc')
    {
        $games = \DB::table('games')
            ->leftJoin('games_developer', 'games.id', '=', 'games_developer.game_id')
            ->leftJoin('developer', 'games_developer.developer_id', '=', 'developer.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('languages', 'languages.id', '=', 'games.lang_id')
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
                'languages.name as langname',
                'languages.short as langshort',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM comments WHERE content_id = games.id AND content_type = "game") as commentcount')
            ->selectRaw('(SELECT SUM(vote_up) FROM comments WHERE content_id = games.id AND content_type = "game") as voteup')
            ->selectRaw('(SELECT SUM(vote_down) FROM comments WHERE content_id = games.id AND content_type = "game") as votedown')
            ->selectRaw('MAX(games_files.release_type) as gametype')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->selectRaw('(SELECT (voteup - votedown) / (voteup + votedown)) as avg')
            ->groupBy('games.id')
            ->orderByRaw($orderby.' '.$direction)
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

        return view('games.index', [
            'games' => $games,
            'gametypes' => $gtypes,
            'maxviews' => DatabaseHelper::getGameViewsMax(),
            'orderby' => $orderby,
            'direction' => $direction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maker = \DB::table('makers')
            ->orderBy('makers.title')
            ->get();

        $langs = \DB::table('languages')
            ->orderBy('id')
            ->get();

        return view('games.create', ['makers' => $maker, 'langs' => $langs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'maker' => 'required|not_in:0',
            'language' => 'required|not_in:0',
            'developer' => 'required',
        ]);

        $devid = DatabaseHelper::developerId_from_developerName($request->get('developer'));
        if ($devid == 0) {
            $devid = DatabaseHelper::developer_add_and_get_developerId($request->get('developer'));
            event(new Obyx('dev-add', \Auth::id()));
        }

        $langid = DatabaseHelper::langId_from_short($request->get('language'));

        $gameid = \DB::table('games')->insertGetId([
            'title' => $request->get('title'),
            'subtitle' => $request->get('subtitle', ''),
            'desc_md' => $request->get('desc'),
            'desc_html' => \Markdown::convertToHtml($request->get('desc')),
            'website_url' => $request->get('websiteurl', ''),
            'maker_id' => $request->get('maker'),
            'lang_id' => $langid,
            'user_id' => \Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        \DB::table('games_developer')->insert([
            'user_id' => \Auth::id(),
            'game_id' => $gameid,
            'developer_id' => $devid,
            'created_at' => Carbon::now(),
        ]);

        event(new Obyx('game-add', \Auth::id()));

        return redirect()->action('MsgBoxController@game_add', [$gameid]);

    }

    /**
     * Add developer to game
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_developer(Request $request, $id){
        $this->validate($request, [
            'developer' => 'required',
        ]);

        $devid = DatabaseHelper::developerId_from_developerName($request->get('developer'));
        if ($devid == 0) {
            $devid = DatabaseHelper::developer_add_and_get_developerId($request->get('developer'));
        }

        \DB::table('games_developer')->insert([
            'user_id' => \Auth::id(),
            'game_id' => $id,
            'developer_id' => $devid,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->action('GameController@edit', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $game = \DB::table('games')
            ->leftJoin('users', 'games.user_id', '=', 'users.id')
            ->leftJoin('makers', 'makers.id', '=', 'games.maker_id')
            ->leftJoin('languages', 'languages.id', '=', 'games.lang_id')
            ->leftJoin('comments', function($join){
                $join->on('comments.content_id', '=', 'games.id');
                $join->on('comments.content_type', '=', \DB::raw("'game'"));
            })
            ->select([
                'games.id as gameid',
                'users.id as userid',
                'users.name as username',
                'games.title',
                'games.subtitle',
                'makers.title as makertitle',
                'makers.short as makershort',
                'makers.id as makerid',
                'games.created_at as createdate',
                'games.desc_html as desc',
                'games.views as views',
                'games.website_url as url',
                'languages.name as langname',
                'languages.short as langshort',
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->selectRaw("(SELECT STR_TO_DATE(CONCAT(release_year,'-',release_month,'-',release_day ), '%Y-%m-%d') FROM games_files WHERE game_id = games.id ORDER BY release_year DESC, release_month DESC, release_day DESC LIMIT 1) as releasedate")
            ->selectRaw('(SELECT COUNT(id) FROM games_coupdecoeur WHERE game_id = games.id) as cdccount')
            ->where('games.id', '=', $id)
            ->first();

        $developer = \DB::table('developer')
            ->leftJoin('games_developer', 'developer.id', '=', 'games_developer.developer_id')
            ->where('games_developer.game_id', '=', $id)
            ->orderBy('games_developer.id')
            ->get();

        $content_type = 'game';

        $comments = \DB::table('comments')
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->select(['comments.id', 'comments.user_id', 'comments.comment_html', 'comments.created_at', 'users.name',
                'comments.vote_up', 'comments.vote_down'])
            ->where('content_type', '=', $content_type)
            ->where('content_id', '=', $id)
            ->orderBy('created_at', 'asc')->get();

        $files = \DB::table('games_files')
            ->select([
                'games_files.id as fileid',
                'games_files_types.title as filetypetitle',
                'games_files_types.short as filetypeshort',
                'games_files.release_version as fileversion',
                'games_files.filename as filename',
                'games_files.extension as fileextension',
                'games_files.filesize as filesize',
                'games_files.release_year as fileyear',
                'games_files.release_month as filemonth',
                'games_files.release_day as fileday',
                'users.id as userid',
                'users.name as username',
                'games_files.created_at as filecreated_at',
                'games_files.downloadcount as downloadcount',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle'
            ])
            ->leftJoin('games_files_types', 'games_files.release_type', '=', 'games_files_types.id')
            ->leftJoin('users', 'games_files.user_id', '=', 'users.id')
            ->leftJoin('games', 'games.id', '=', 'games_files.game_id')
            ->where('games_files.game_id', '=', $id)
            ->orderBy('games_files_types.id', 'desc')
            ->orderBy('fileyear', 'desc')
            ->orderBy('filemonth', 'desc')
            ->orderBy('fileday', 'desc')
            ->limit(5)
            ->get();

        $releasedate = \DB::table('games_files')
            ->where('game_id', '=', $id)
            ->orderBy('release_type', 'desc')
            ->orderBy('release_year', 'desc')
            ->orderBy('release_month', 'desc')
            ->orderBy('release_day', 'desc')
            ->groupBy('release_type')
            ->first();

        $awards = \DB::table('games_awards')
            ->leftJoin('award_cats', 'games_awards.award_cat_id', '=', 'award_cats.id')
            ->leftJoin('award_pages', 'award_pages.id', '=', 'games_awards.award_page_id')
            ->leftJoin('award_subcats', 'award_subcats.id', '=', 'games_awards.award_subcat_id')
            ->select([
                'games_awards.place as place',
                'award_cats.year as year',
                'award_pages.title as pagetitle',
                'award_cats.id as catid',
                'award_cats.title as cattitle',
                'award_subcats.title as subtitle'
            ])
            ->where('games_awards.game_id', '=', $id)
            ->where('games_awards.place', '<', 4)
            ->orderBy('games_awards.place')
            ->orderBy('award_subcats.title')
            ->get();

        $creds = \DB::table('user_credit_types')
            ->orderBy('title')
            ->get();

        $credittypes = array();
        foreach ($creds as $cred) {
            $credittypes[$cred->id]['title'] = $cred->title;
            $credittypes[$cred->id]['id'] = $cred->id;
        }

        $credits = \DB::table('user_credits')
            ->leftJoin('users', 'users.id', '=', 'user_credits.user_id')
            ->select([
                'user_credits.credit_type_id as credit_type_id',
                'user_credits.id as id',
                'users.id as userid',
                'users.name as username',
            ])
            ->where('game_id', '=', $id)
            ->get();

        if(\Auth::check()){
            $userlists = \DB::table('user_lists')
                ->where('user_id', '=', \Auth::id())
                ->get();
        }else{
            $userlists = null;
        }

        $tags = \DB::table('tag_relations')
            ->leftJoin('tags', 'tags.id', '=', 'tag_relations.tag_id')
            ->where('content_id', '=', $id)
            ->where('content_type', '=', 'game')
            ->groupBy('tags.id')
            ->orderByRaw('COUNT(tag_relations.id)')
            ->limit(10)
            ->get();

        event(new GameView($id));

        return view('games.show', [
            'game' => $game,
            'comments' => $comments,
            'developer' => $developer,
            'files' => $files,
            'releasedate' => $releasedate,
            'awards' => $awards,
            'credittypes' => $credittypes,
            'credits' => $credits,
            'userlists' => $userlists,
            'tags' => $tags,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = \DB::table('games')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'games.maker_id as gamemakerid',
                'games.lang_id as gamelangid',
                'games.desc_md as gamedescmd',
                'games.website_url as websiteurl'
            ])
            ->where('games.id', '=', $id)
            ->first();

        $makers = \DB::table('makers')
            ->get();

        $langs = \DB::table('languages')
            ->get();

        $developers = \DB::table('developer')
            ->select([
                'developer.name as devname',
                'developer.id as devid'
            ])
            ->leftJoin('games_developer', 'games_developer.developer_id', '=', 'developer.id')
            ->where('games_developer.game_id', '=', $id)
            ->get();

        $creds = \DB::table('user_credit_types')
            ->orderBy('title')
            ->get();

        $credittypes = array();
        foreach ($creds as $cred) {
            $credittypes[$cred->id]['title'] = $cred->title;
            $credittypes[$cred->id]['id'] = $cred->id;
        }

        $credits = \DB::table('user_credits')
            ->leftJoin('users', 'users.id', '=', 'user_credits.user_id')
            ->select([
                'user_credits.credit_type_id as credit_type_id',
                'user_credits.id as id',
                'users.id as userid',
                'users.name as username',
            ])
            ->where('game_id', '=', $id)
            ->get();




        return view('games.edit', [
            'game' => $game,
            'makers' => $makers,
            'developers' => $developers,
            'gamefiles' => '',
            'langs' => $langs,
            'credittypes' => $credittypes,
            'credits' => $credits,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lang = Language::whereShort($request->get('language'))->first();

        $game = Game::whereId($id)->first();
        $game->title = $request->get('title');
        $game->subtitle = $request->get('subtitle');
        $game->maker_id = $request->get('maker');
        $game->lang_id = $lang->id;
        $game->desc_md = $request->get('desc');
        $game->desc_html = \Markdown::convertToHtml($request->get('desc'));
        $game->website_url = $request->get('websiteurl');
        $game->save();

        return redirect()->action('GameController@edit', [$id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validate = Input::get('confirm','');
        if(\Auth::check()){
            if(\Auth::user()->can('delete-games')){
                if($validate == 'CONFIRM+'.$id){
                    Game::whereId($id)->delete();
                    GamesFile::whereGameId($id)->delete();
                    Screenshot::whereGameId($id)->delete();
                    GamesDeveloper::whereGameId($id)->delete();
                    Comment::whereContentId($id)->where('content_type', '=', 'game')->delete();
                    TagRelation::whereContentId($id)->where('content_type', '=', 'game')->delete();
                }else{
                    return redirect()->action('GameController@edit', $id);
                }
            }
        }


        return redirect()->route('home');
    }

    public function destroy_developer(Request $request, $id){
        \DB::table('games_developer')
            ->where('game_id', '=', $id)
            ->where('developer_id', '=', $request->get('devid'))
            ->delete();

        return redirect()->action('GameController@edit', [$id]);
    }
}
