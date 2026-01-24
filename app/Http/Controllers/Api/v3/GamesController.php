<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GamesFile;
use App\Models\Screenshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
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

        $gamesQuery = Game::query()
            ->with(['maker', 'language'])
            ->orderBy('title')
            ->orderBy('subtitle');

        if (! Auth::check()) {
            $gamesQuery->where('nsfw', '=', false);
        }

        $gamesQuery->where('is_banned', '=', 0);

        $games = $gamesQuery->paginate($perPage);

        $data = $games->getCollection()->map(function (Game $game) {
            return [
                'id' => $game->id,
                'title' => $game->title,
                'subtitle' => $game->subtitle,
                'release_date' => $game->release_date,
                'maker' => $game->maker ? [
                    'id' => $game->maker->id,
                    'title' => $game->maker->title,
                    'short' => $game->maker->short,
                ] : null,
                'language' => $game->language ? [
                    'id' => $game->language->id,
                    'name' => $game->language->name,
                    'short' => $game->language->short,
                ] : null,
                'votes' => [
                    'up' => (int) ($game->voteup ?? 0),
                    'down' => (int) ($game->votedown ?? 0),
                    'avg' => (float) ($game->avg ?? 0),
                ],
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'List of games',
            'data' => $data,
            'meta' => [
                'page' => $games->currentPage(),
                'per_page' => $games->perPage(),
                'total' => $games->total(),
                'last_page' => $games->lastPage(),
            ],
        ]);
    }

    public function show(Request $request, $id)
    {
        \Debugbar::disable();

        $game = Game::with([
            'maker',
            'language',
            'developers.developer',
            'tags.tag',
        ])->whereId($id)->first();

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

        $screens = Screenshot::whereGameId($game->id)
            ->orderBy('screenshot_id')
            ->get();

        $gamefiles = GamesFile::whereGameId($game->id)
            ->where('forbidden', '=', 0)
            ->orderBy('release_type', 'desc')
            ->orderBy('release_year', 'desc')
            ->orderBy('release_month', 'desc')
            ->orderBy('release_day', 'desc')
            ->with(['gamefiletype', 'language'])
            ->get();

        $developers = [];
        foreach ($game->developers as $dev) {
            if ($dev->developer) {
                $developers[] = [
                    'id' => $dev->developer->id,
                    'name' => $dev->developer->name,
                ];
            }
        }

        $tags = [];
        foreach ($game->tags as $tagRelation) {
            if ($tagRelation->tag) {
                $tags[] = [
                    'id' => $tagRelation->tag->id,
                    'title' => $tagRelation->tag->title,
                ];
            }
        }

        $data = [
            'id' => $game->id,
            'title' => $game->title,
            'subtitle' => $game->subtitle,
            'release_date' => $game->release_date,
            'description_md' => $game->desc_md,
            'description_html' => $game->desc_html,
            'website_url' => $game->website_url,
            'youtube' => $game->youtube,
            'maker' => $game->maker ? [
                'id' => $game->maker->id,
                'title' => $game->maker->title,
                'short' => $game->maker->short,
            ] : null,
            'language' => $game->language ? [
                'id' => $game->language->id,
                'name' => $game->language->name,
                'short' => $game->language->short,
            ] : null,
            'developers' => $developers,
            'tags' => $tags,
            'votes' => [
                'up' => (int) ($game->voteup ?? 0),
                'down' => (int) ($game->votedown ?? 0),
                'avg' => (float) ($game->avg ?? 0),
            ],
            'screenshots' => $this->formatScreenshots($game->id, $screens),
            'gamefiles' => $this->formatGamefiles($gamefiles, $timestamp),
        ];

        return response()->json([
            'status_code' => 200,
            'message' => 'Game details',
            'data' => $data,
        ]);
    }

    private function formatScreenshots(int $gameId, $screens)
    {
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

        return $data;
    }

    private function formatGamefiles($gamefiles, int $timestamp)
    {
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

        return $data;
    }
}
