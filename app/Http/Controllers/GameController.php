<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Events\Obyx;
use App\Models\Game;
use App\Models\Comment;
use App\Models\License;
use App\Events\GameView;
use App\Models\Language;
use App\Models\GamesFile;
use App\Models\Screenshot;
use App\Helpers\MiscHelper;
use App\Models\TagRelation;
use Illuminate\Http\Request;
use App\Models\GamesDeveloper;
use App\Helpers\DatabaseHelper;
use Illuminate\Support\Facades\Input;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($orderby = 'title', $direction = 'asc')
    {
        $rows = (\Auth::check()) ? \Auth::user()->settings->rows_per_page_games : config('app.rows_per_page_games');

        if ($orderby == 'developer.name') {
            $games = Game::Join('games_developer', 'games.id', '=', 'games_developer.game_id')
                ->Join('developer', 'games_developer.developer_id', '=', 'developer.id')
                ->orderBy($orderby, $direction)->select('games.*')->paginate($rows);
        } else {
            $games = Game::orderBy($orderby, $direction)->orderBy('title')->orderBy('subtitle')->paginate($rows);
        }

        return view('games.index', [
            'games'     => $games,
            'maxviews'  => DatabaseHelper::getGameViewsMax(),
            'orderby'   => $orderby,
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

        $licenses = License::get();

        return view('games.create', ['makers' => $maker, 'langs' => $langs, 'licenses' => $licenses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'maker'     => 'required|not_in:0',
            'language'  => 'required|not_in:0',
            'developer' => 'required',
        ]);

        $devid = DatabaseHelper::developerId_from_developerName($request->get('developer'));
        if ($devid == 0) {
            $devid = DatabaseHelper::developer_add_and_get_developerId($request->get('developer'));
            event(new Obyx('dev-add', \Auth::id()));
        }

        $langid = DatabaseHelper::langId_from_short($request->get('language'));

        $g = new Game();
        $g->title = $request->get('title');
        $g->subtitle = $request->get('subtitle', '');
        $g->desc_md = $request->get('msg');
        $g->desc_html = \Markdown::convertToHtml($request->get('msg'));
        $g->website_url = $request->get('websiteurl', '');
        $g->maker_id = $request->get('maker');
        $g->lang_id = $langid;
        $g->user_id = \Auth::id();
        $g->youtube = $request->get('youtube');
        $g->atelier_id = $request->get('atelier_id');
        $g->license_id = $request->get('license');
        $g->save();

        \DB::table('games_developer')->insert([
            'user_id'      => \Auth::id(),
            'game_id'      => $g->id,
            'developer_id' => $devid,
            'created_at'   => Carbon::now(),
        ]);

        event(new Obyx('game-add', \Auth::id()));
        MiscHelper::sendTelegram('['.\Auth::user()->name.'](http://rmarchiv.tk/users/'.\Auth::user()->id.') hat ein neues Spiel angelegt:'.PHP_EOL.'*'.$g->title.'*');

        return redirect()->action('MsgBoxController@game_add', [$g->id]);
    }

    /**
     * Add developer to game.
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_developer(Request $request, $id)
    {
        $this->validate($request, [
            'developer' => 'required',
        ]);

        $devid = DatabaseHelper::developerId_from_developerName($request->get('developer'));
        if ($devid == 0) {
            $devid = DatabaseHelper::developer_add_and_get_developerId($request->get('developer'));
        }

        \DB::table('games_developer')->insert([
            'user_id'      => \Auth::id(),
            'game_id'      => $id,
            'developer_id' => $devid,
            'created_at'   => Carbon::now(),
        ]);

        return redirect()->action('GameController@edit', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::with('developers')->whereId($id)->first();

        event(new GameView($id));

        return view('games.show', [
            'game' => $game,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $makers = \DB::table('makers')
            ->get();

        $langs = \DB::table('languages')
            ->get();

        $creds = \DB::table('user_credit_types')
            ->orderBy('title')
            ->get();

        $credittypes = [];
        foreach ($creds as $cred) {
            $credittypes[$cred->id]['title'] = $cred->title;
            $credittypes[$cred->id]['id'] = $cred->id;
        }

        $licenses = License::get();

        $game = Game::whereId($id)->first();

        return view('games.edit', [
            'game'     => $game,
            'makers'   => $makers,
            //'developers'  => $developers,
            'langs'    => $langs,
            'licenses' => $licenses,
            //'credittypes' => $credittypes,
            //'credits'     => $credits,
            //'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $lang = Language::whereShort($request->get('language'))->first();

        $game = Game::whereId($id)->first();
        $game->title = $request->get('title');
        $game->subtitle = $request->get('subtitle');
        $game->maker_id = $request->get('maker');
        $game->lang_id = $lang->id;
        $game->desc_md = $request->get('msg');
        $game->desc_html = \Markdown::convertToHtml($request->get('msg'));
        $game->website_url = $request->get('websiteurl');
        $game->youtube = $request->get('youtube');
        $game->atelier_id = $request->get('atelier_id');
        $game->release_date = Carbon::createFromDate($request->get('releasedate_year'), $request->get('releasedate_month'), $request->get('releasedate_day'));
        $game->license_id = $request->get('license');
        $game->save();

        return redirect()->action('GameController@edit', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $validate = Input::get('confirm', '');
        if (\Auth::check()) {
            if (\Auth::user()->can('delete-games')) {
                if ($validate == 'CONFIRM+'.$id) {
                    Game::whereId($id)->delete();
                    GamesFile::whereGameId($id)->delete();
                    Screenshot::whereGameId($id)->delete();
                    GamesDeveloper::whereGameId($id)->delete();
                    Comment::whereContentId($id)->where('content_type', '=', 'game')->delete();
                    TagRelation::whereContentId($id)->where('content_type', '=', 'game')->delete();
                } else {
                    return redirect()->action('GameController@edit', $id);
                }
            }
        }

        return redirect()->route('home');
    }

    public function destroy_developer(Request $request, $id)
    {
        \DB::table('games_developer')
            ->where('game_id', '=', $id)
            ->where('developer_id', '=', $request->get('devid'))
            ->delete();

        return redirect()->action('GameController@edit', [$id]);
    }
}
