<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.token')->only(['store']);
    }

    public function index(Request $request)
    {
        \Debugbar::disable();

        $type = (string) $request->query('type', '');
        $contentId = (int) $request->query('id', 0);
        $allowed = ['game', 'news', 'resource', 'event'];

        if ($contentId <= 0 || ! in_array($type, $allowed, true)) {
            return response()->json([
                'status_code' => 422,
                'message' => 'type and id are required.',
            ], 422);
        }

        $comments = Comment::where('content_type', '=', $type)
            ->where('content_id', '=', $contentId)
            ->where('deleted', '=', 0)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function (Comment $comment) {
                return [
                    'id' => $comment->id,
                    'user' => $comment->user ? [
                        'id' => $comment->user->id,
                        'name' => $comment->user->name,
                    ] : null,
                    'comment_md' => $comment->comment_md,
                    'comment_html' => $comment->comment_html,
                    'vote_up' => (int) $comment->vote_up,
                    'vote_down' => (int) $comment->vote_down,
                    'created_at' => $comment->created_at,
                ];
            });

        return response()->json([
            'status_code' => 200,
            'message' => 'Comments',
            'data' => $comments,
        ]);
    }

    public function store(Request $request)
    {
        \Debugbar::disable();

        $type = (string) $request->input('type', '');
        $contentId = (int) $request->input('id', 0);
        $message = (string) $request->input('comment', '');
        $allowed = ['game', 'news', 'resource', 'event'];

        if ($contentId <= 0 || ! in_array($type, $allowed, true) || trim($message) === '') {
            return response()->json([
                'status_code' => 422,
                'message' => 'type, id and comment are required.',
            ], 422);
        }

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content_id = $contentId;
        $comment->content_type = $type;
        $comment->comment_md = $message;
        $comment->comment_html = Markdown::convert($message);
        $comment->vote_up = 0;
        $comment->vote_down = 0;
        $comment->deleted = 0;
        $comment->save();

        return response()->json([
            'status_code' => 201,
            'message' => 'Comment added',
            'data' => [
                'id' => $comment->id,
            ],
        ], 201);
    }
}
