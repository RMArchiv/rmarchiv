<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CDCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cdc.create');
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
            'gamename' => 'required',
        ]);

        // Prüfen ob das Spiel auch wirklich existiert
        $title = explode(" -=- ",$request->get('gamename'));

        if(count($title) == 1){
            $game = \DB::table('games')
                ->select([
                    'id'
                ])
                ->where('title', '=', $title[0])
                ->first();
        }else{
            $game = \DB::table('games')
                ->select([
                    'id'
                ])
                ->where('title', '=', $title[0])
                ->orWhere('subtitle', '=', $title[1])
                ->first();
        }

        \DB::table('games_coupdecoeur')->insert([
            'game_id' => $game->id,
            'user_id' => \Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->action('MsgBoxController@cdc_add', [$game->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
