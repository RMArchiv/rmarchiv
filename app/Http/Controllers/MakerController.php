<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Maker;
use Illuminate\Http\Request;

class MakerController extends Controller
{
    public function index($orderby = 'title', $direction = 'asc'){

        $makers = Maker::orderBy($orderby, $direction)
            ->paginate(25);

        return view('maker.index', [
            'makers' => $makers,
            'orderby' => $orderby,
            'direction' => $direction,
        ]);
    }

    public function show($makerid, $orderby = 'title', $direction = 'asc'){
        $games = Game::where('maker_id', '=', $makerid)
            ->orderBy($orderby, $direction)
            ->paginate(20);

        return view('maker.show', [
            'games' => $games,
            'orderby' => $orderby,
            'direction' => $direction,
            'id' => $makerid,
        ]);
    }
}
