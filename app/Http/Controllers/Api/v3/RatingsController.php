<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Events\Obyx;
use App\Helpers\CheckRateableHelper;
use App\Helpers\DatabaseHelper;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Game;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.token');
    }

    public function store(Request $request, $gameId)
    {
        \Debugbar::disable();

        $game = Game::whereId($gameId)->first();
        if (! $game) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Game not found',
            ], 404);
        }

        $rating = $request->input('rating');
        if (! in_array($rating, ['up', 'down'], true)) {
            return response()->json([
                'status_code' => 422,
                'message' => 'Invalid rating. Use "up" or "down".',
            ], 422);
        }

        $allowedToRate = CheckRateableHelper::checkRateable('game', $gameId, Auth::id());
        if (! $allowedToRate) {
            return response()->json([
                'status_code' => 409,
                'message' => 'User has already rated this game.',
            ], 409);
        }

        $commentText = (string) $request->input('comment', '');

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content_id = $gameId;
        $comment->content_type = 'game';
        $comment->comment_md = $commentText;
        $comment->comment_html = $commentText !== '' ? Markdown::convert($commentText) : '';
        $comment->vote_up = $rating === 'up' ? 1 : 0;
        $comment->vote_down = $rating === 'down' ? 1 : 0;
        $comment->deleted = 0;
        $comment->save();

        DatabaseHelper::setVotesAndComments($gameId);
        event(new Obyx('rating', Auth::id()));

        $game->refresh();

        return response()->json([
            'status_code' => 201,
            'message' => 'Rating submitted',
            'data' => [
                'game_id' => $gameId,
                'rating' => $rating,
                'votes' => [
                    'up' => (int) ($game->voteup ?? 0),
                    'down' => (int) ($game->votedown ?? 0),
                    'avg' => (float) ($game->avg ?? 0),
                ],
            ],
        ], 201);
    }
}
