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
use Illuminate\Http\Request;
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
        if ($orderby == 'developer.name') {
            $games = Game::Join('games_developer', 'games.id', '=', 'games_developer.game_id')
                ->Join('developer', 'games_developer.developer_id', '=', 'developer.id')
                ->orderBy($orderby, $direction)->select('games.*')->paginate(20);
        } elseif ($orderby == 'game.release_date') {
            $games = Game::Join('games_files', 'games.id', '=', 'games_files.game_id')
                ->orderBy('games_files.release_year', $direction)
                ->orderBy('games_files.release_month', $direction)
                ->orderBy('games_files.release_day', $direction)
                ->select('games.*')
                ->paginate(20);
        } else {
            $games = Game::orderBy($orderby, $direction)->orderBy('title')->orderBy('subtitle')->paginate(20);
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

        return view('games.create', ['makers' => $maker, 'langs' => $langs]);
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
        $g->desc_md = $request->get('desc');
        $g->desc_html = \Markdown::convertToHtml($request->get('desc'));
        $g->website_url = $request->get('websiteurl', '');
        $g->maker_id = $request->get('maker');
        $g->lang_id = $langid;
        $g->user_id = \Auth::id();
        $g->youtube = $request->get('youtube');
        $g->save();

        \DB::table('games_developer')->insert([
            'user_id'      => \Auth::id(),
            'game_id'      => $g->id,
            'developer_id' => $devid,
            'created_at'   => Carbon::now(),
        ]);

        event(new Obyx('game-add', \Auth::id()));

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
        $game = \DB::table('games')
            ->select([
                'games.id as gameid',
                'games.title as gametitle',
                'games.subtitle as gamesubtitle',
                'games.maker_id as gamemakerid',
                'games.lang_id as gamelangid',
                'games.desc_md as gamedescmd',
                'games.website_url as websiteurl',
                'games.youtube as youtube',
                'games.release_date as release_date',
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
                'developer.id as devid',
            ])
            ->leftJoin('games_developer', 'games_developer.developer_id', '=', 'developer.id')
            ->where('games_developer.game_id', '=', $id)
            ->get();

        $creds = \DB::table('user_credit_types')
            ->orderBy('title')
            ->get();

        $credittypes = [];
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
            'game'        => $game,
            'makers'      => $makers,
            'developers'  => $developers,
            'gamefiles'   => '',
            'langs'       => $langs,
            'credittypes' => $credittypes,
            'credits'     => $credits,
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
        $game->desc_md = $request->get('desc');
        $game->desc_html = \Markdown::convertToHtml($request->get('desc'));
        $game->website_url = $request->get('websiteurl');
        $game->youtube = $request->get('youtube');
        $game->release_date = Carbon::createFromDate($request->get('releasedate_year'), $request->get('releasedate_month'), $request->get('releasedate_day'));
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
