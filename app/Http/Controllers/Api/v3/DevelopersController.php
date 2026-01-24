<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\GamesDeveloper;
use Illuminate\Http\Request;

class DevelopersController extends Controller
{
    public function index(Request $request)
    {
        \Debugbar::disable();

        $perPage = (int) $request->query('per_page', 50);
        if ($perPage < 1) {
            $perPage = 1;
        }
        if ($perPage > 200) {
            $perPage = 200;
        }

        $developers = Developer::orderBy('name')->paginate($perPage);

        return response()->json([
            'status_code' => 200,
            'message' => 'Developers',
            'data' => $developers->items(),
            'meta' => [
                'page' => $developers->currentPage(),
                'per_page' => $developers->perPage(),
                'total' => $developers->total(),
                'last_page' => $developers->lastPage(),
            ],
        ]);
    }

    public function show($id)
    {
        \Debugbar::disable();

        $developer = Developer::whereId($id)->first();
        if (! $developer) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Developer not found',
            ], 404);
        }

        $games = GamesDeveloper::with('game')
            ->where('developer_id', '=', $id)
            ->get()
            ->map(function (GamesDeveloper $rel) {
                return $rel->game ? [
                    'id' => $rel->game->id,
                    'title' => $rel->game->title,
                    'subtitle' => $rel->game->subtitle,
                ] : null;
            })
            ->filter()
            ->values();

        return response()->json([
            'status_code' => 200,
            'message' => 'Developer',
            'data' => [
                'id' => $developer->id,
                'name' => $developer->name,
                'short' => $developer->short,
                'website_url' => $developer->website_url,
                'user_id' => $developer->user_id,
                'games' => $games,
            ],
        ]);
    }
}
