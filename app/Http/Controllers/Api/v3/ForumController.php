<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\BoardCat;
use App\Models\BoardPost;
use App\Models\BoardThread;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function categories()
    {
        \Debugbar::disable();

        $cats = BoardCat::orderBy('order')
            ->get(['id', 'order', 'title', 'desc', 'last_created_at', 'last_user_id']);

        return response()->json([
            'status_code' => 200,
            'message' => 'Forum categories',
            'data' => $cats,
        ]);
    }

    public function threads(Request $request)
    {
        \Debugbar::disable();

        $perPage = (int) $request->query('per_page', 50);
        if ($perPage < 1) {
            $perPage = 1;
        }
        if ($perPage > 200) {
            $perPage = 200;
        }

        $query = BoardThread::with('user')->orderBy('last_created_at', 'desc');
        $catId = (int) $request->query('cat_id', 0);
        if ($catId > 0) {
            $query->where('cat_id', '=', $catId);
        }

        $threads = $query->paginate($perPage);

        $data = collect($threads->items())->map(function (BoardThread $thread) {
            return [
                'id' => $thread->id,
                'cat_id' => $thread->cat_id,
                'title' => $thread->title,
                'closed' => (int) $thread->closed,
                'pinned' => (int) $thread->pinned,
                'last_created_at' => $thread->last_created_at,
                'user' => $thread->user ? [
                    'id' => $thread->user->id,
                    'name' => $thread->user->name,
                ] : null,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'Forum threads',
            'data' => $data,
            'meta' => [
                'page' => $threads->currentPage(),
                'per_page' => $threads->perPage(),
                'total' => $threads->total(),
                'last_page' => $threads->lastPage(),
            ],
        ]);
    }

    public function thread($id)
    {
        \Debugbar::disable();

        $thread = BoardThread::with(['user', 'cat'])->whereId($id)->first();
        if (! $thread) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Thread not found',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Thread',
            'data' => [
                'id' => $thread->id,
                'cat' => $thread->cat ? [
                    'id' => $thread->cat->id,
                    'title' => $thread->cat->title,
                ] : null,
                'title' => $thread->title,
                'closed' => (int) $thread->closed,
                'pinned' => (int) $thread->pinned,
                'created_at' => $thread->created_at,
                'last_created_at' => $thread->last_created_at,
                'user' => $thread->user ? [
                    'id' => $thread->user->id,
                    'name' => $thread->user->name,
                ] : null,
            ],
        ]);
    }

    public function posts(Request $request, $threadId)
    {
        \Debugbar::disable();

        $thread = BoardThread::whereId($threadId)->first();
        if (! $thread) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Thread not found',
            ], 404);
        }

        $perPage = (int) $request->query('per_page', 50);
        if ($perPage < 1) {
            $perPage = 1;
        }
        if ($perPage > 200) {
            $perPage = 200;
        }

        $posts = BoardPost::with('user')
            ->where('thread_id', '=', $threadId)
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);

        $data = collect($posts->items())->map(function (BoardPost $post) {
            return [
                'id' => $post->id,
                'user' => $post->user ? [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                ] : null,
                'content_md' => $post->content_md,
                'content_html' => $post->content_html,
                'created_at' => $post->created_at,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'Thread posts',
            'data' => $data,
            'meta' => [
                'page' => $posts->currentPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
                'last_page' => $posts->lastPage(),
            ],
        ]);
    }
}
