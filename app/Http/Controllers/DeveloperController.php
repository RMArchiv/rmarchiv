<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamesDeveloper;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $games = GamesDeveloper::with('game', 'developer')->whereDeveloperId($id)->get();

        return view('developer.show', [
            'games' => $games,
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
