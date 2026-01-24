<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Events\Obyx;
use App\Helpers\DatabaseHelper;
use App\Models\BoardCat;
use App\Models\BoardPost;
use App\Models\BoardThread;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.token')->only(['storeThread', 'storePost']);
    }

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

    public function storeThread(Request $request)
    {
        \Debugbar::disable();

        $catId = (int) $request->input('cat_id', 0);
        $title = trim((string) $request->input('title', ''));
        $message = trim((string) $request->input('message', ''));

        if ($catId <= 0 || $title === '' || $message === '') {
            return response()->json([
                'status_code' => 422,
                'message' => 'cat_id, title and message are required.',
            ], 422);
        }

        $cat = BoardCat::whereId($catId)->first();
        if (! $cat) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Category not found',
            ], 404);
        }

        $date = Carbon::now();

        $thread = new BoardThread();
        $thread->cat_id = $catId;
        $thread->user_id = Auth::id();
        $thread->title = $title;
        $thread->closed = 0;
        $thread->pinned = 0;
        $thread->last_user_id = Auth::id();
        $thread->created_at = $date;
        $thread->last_created_at = $date;
        $thread->save();

        $post = new BoardPost();
        $post->cat_id = $catId;
        $post->thread_id = $thread->id;
        $post->user_id = Auth::id();
        $post->content_md = $message;
        $post->content_html = Markdown::convert($message);
        $post->created_at = $date;
        $post->save();

        BoardCat::whereId($catId)->update([
            'last_created_at' => $date,
            'last_user_id' => Auth::id(),
        ]);

        event(new Obyx('thread-add', Auth::id()));
        event(new Obyx('post-add', Auth::id()));
        DatabaseHelper::setThreadViewDate($thread->id);

        return response()->json([
            'status_code' => 201,
            'message' => 'Thread created',
            'data' => [
                'thread_id' => $thread->id,
                'post_id' => $post->id,
            ],
        ], 201);
    }

    public function storePost(Request $request, $threadId)
    {
        \Debugbar::disable();

        $thread = BoardThread::whereId($threadId)->first();
        if (! $thread) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Thread not found',
            ], 404);
        }

        if ((int) $thread->closed === 1) {
            return response()->json([
                'status_code' => 409,
                'message' => 'Thread is closed.',
            ], 409);
        }

        $message = trim((string) $request->input('message', ''));
        if ($message === '') {
            return response()->json([
                'status_code' => 422,
                'message' => 'message is required.',
            ], 422);
        }

        $date = Carbon::now();

        $post = new BoardPost();
        $post->cat_id = $thread->cat_id;
        $post->thread_id = $thread->id;
        $post->user_id = Auth::id();
        $post->content_md = $message;
        $post->content_html = Markdown::convert($message);
        $post->created_at = $date;
        $post->save();

        BoardThread::whereId($thread->id)->update([
            'last_created_at' => $date,
            'last_user_id' => Auth::id(),
        ]);

        BoardCat::whereId($thread->cat_id)->update([
            'last_created_at' => $date,
            'last_user_id' => Auth::id(),
        ]);

        event(new Obyx('post-add', Auth::id()));

        return response()->json([
            'status_code' => 201,
            'message' => 'Post created',
            'data' => [
                'post_id' => $post->id,
                'thread_id' => $thread->id,
            ],
        ], 201);
    }
}
