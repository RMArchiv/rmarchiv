<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Game;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($orderby = 'devname', $direction = 'asc')
    {
        $developer = \DB::table('developer')
            ->leftJoin('games_developer', 'games_developer.developer_id', '=', 'developer.id')
            ->select([
                'developer.id as devid',
                'developer.name as devname',
            ])
            ->selectRaw('COUNT(games_developer.id) as gamecount')
            ->groupBy('developer.id')
            ->orderBy($orderby, $direction)
            ->get();

        return view('developer.index', [
            'developer' => $developer,
            'orderby'   => $orderby,
            'direction' => $direction,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $orderby = 'title', $direction = 'asc')
    {
        $games = Game::with('developers')
            ->leftjoin('games_developer as gd', 'gd.game_id', '=', 'games.id')
            ->where('gd.developer_id', '=', $id)
            ->orderBy($orderby, $direction)
            ->paginate(20, [
                'games.*',
            ]);

        return view('developer.show', [
            'games' => $games,
            'orderby' => $orderby,
            'direction' => $direction,
        ]);
    }
}
