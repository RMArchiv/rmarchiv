<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Screenshot;
use Illuminate\Support\Facades\Auth;

class ScreenshotsController extends Controller
{
    public function index($gameId)
    {
        \Debugbar::disable();

        $game = Game::whereId($gameId)->first();
        if (! $game) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Game not found',
            ], 404);
        }

        if (! Auth::check() && $game->nsfw) {
            return response()->json([
                'status_code' => 403,
                'message' => 'Game not accessible',
            ], 403);
        }

        if ((int) $game->is_banned === 1) {
            return response()->json([
                'status_code' => 403,
                'message' => 'Game is banned',
            ], 403);
        }

        $screens = Screenshot::whereGameId($gameId)
            ->orderBy('screenshot_id')
            ->get();

        $data = [];
        foreach ($screens as $screen) {
            $data[] = [
                'id' => $screen->id,
                'screenshot_id' => $screen->screenshot_id,
                'url' => route('screenshot.show', [
                    'gameid' => $gameId,
                    'screenid' => $screen->screenshot_id,
                ]),
                'full_url' => route('screenshot.show', [
                    'gameid' => $gameId,
                    'screenid' => $screen->screenshot_id,
                    'full' => 'full',
                ]),
            ];
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Screenshots',
            'data' => $data,
        ]);
    }
}
