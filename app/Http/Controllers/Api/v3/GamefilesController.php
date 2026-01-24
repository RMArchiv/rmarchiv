<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GamesFile;
use Illuminate\Support\Facades\Auth;

class GamefilesController extends Controller
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

        $timestamp = time();
        $gamefiles = GamesFile::whereGameId($gameId)
            ->where('forbidden', '=', 0)
            ->orderBy('release_type', 'desc')
            ->orderBy('release_year', 'desc')
            ->orderBy('release_month', 'desc')
            ->orderBy('release_day', 'desc')
            ->with(['gamefiletype', 'language'])
            ->get();

        $data = [];
        foreach ($gamefiles as $gamefile) {
            $data[] = [
                'id' => $gamefile->id,
                'release_type' => $gamefile->gamefiletype ? [
                    'id' => $gamefile->gamefiletype->id,
                    'title' => $gamefile->gamefiletype->title,
                ] : null,
                'release_version' => $gamefile->release_version,
                'release_date' => $gamefile->release_year . '-' . str_pad($gamefile->release_month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($gamefile->release_day, 2, '0', STR_PAD_LEFT),
                'filesize' => $gamefile->filesize,
                'extension' => $gamefile->extension,
                'language' => $gamefile->language ? [
                    'id' => $gamefile->language->id,
                    'name' => $gamefile->language->name,
                    'short' => $gamefile->language->short,
                ] : null,
                'download_url' => route('gamefiles.download', [
                    'id' => $gamefile->id,
                    'ts' => $timestamp,
                ]),
            ];
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Gamefiles',
            'data' => $data,
        ]);
    }
}
