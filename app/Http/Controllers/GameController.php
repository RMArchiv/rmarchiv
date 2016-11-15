<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseHelper;
use App\Models\Game;
use App\Models\GamesDeveloper;
use Illuminate\Http\Request;
use Symfony\Component\Console\Descriptor\MarkdownDescriptor;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('games.index');
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
     * @param  \Illuminate\Http\Request  $request
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
        if($devid == 0){
            $devid = DatabaseHelper::developer_add_and_get_developerId($request->get('developer'));
        }

        $langid = DatabaseHelper::langId_from_short($request->get('language'));

        $g = new Game;

        $g->title = $request->get('title');
        $g->subtitle = $request->get('subtitle', '');
        $g->desc_md = $request->get('desc');
        $g->desc_html = \Markdown::convertToHtml($request->get('desc'));
        $g->website_url = $request->get('websiteurl', '');
        $g->maker_id = $request->get('maker');
        $g->lang_id = $langid;
        $g->user_id = \Auth::id();
        $g->save;

        $devrel = new GamesDeveloper;
        $devrel->user_id = \Auth::id();
        $devrel->developer_id = $devid;
        $devrel->game_id = $g->id;

        return redirect()->action('MsgBoxController@game_add', [$g->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('games.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('games.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
