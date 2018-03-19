<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Models\GamesCoupdecoeur;

class CDCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cdc = GamesCoupdecoeur::all();

        return view('cdc.index', [
            'cdcs' => $cdc,
        ]);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'gamename' => 'required',
        ]);

        // Prüfen ob das Spiel auch wirklich existiert
        $title = explode(' -=- ', $request->get('gamename'));

        if (count($title) == 1) {
            $game = Game::whereTitle($title[0])
                ->first();
        } else {
            $game = Game::whereTitle($title[0])
                ->orWhere('subtitle', '=', $title[1])
                ->first();
        }

        \DB::table('games_coupdecoeur')->insert([
            'game_id'    => $game->id,
            'user_id'    => \Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->action('MsgBoxController@cdc_add', [$game->id]);
    }
}
