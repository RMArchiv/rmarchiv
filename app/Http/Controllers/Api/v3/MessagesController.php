<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\MessengerMessage;
use App\Models\MessengerParticipant;
use App\Models\MessengerThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.token');
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

        $participantThreadIds = MessengerParticipant::where('user_id', '=', Auth::id())
            ->pluck('thread_id');

        $threads = MessengerThread::whereIn('id', $participantThreadIds)
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status_code' => 200,
            'message' => 'Message threads',
            'data' => $threads->items(),
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

        $participant = MessengerParticipant::where('thread_id', '=', $id)
            ->where('user_id', '=', Auth::id())
            ->first();

        if (! $participant) {
            return response()->json([
                'status_code' => 403,
                'message' => 'Not allowed to access this thread.',
            ], 403);
        }

        $thread = MessengerThread::whereId($id)->first();
        if (! $thread) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Thread not found',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Message thread',
            'data' => $thread,
        ]);
    }

    public function messages(Request $request, $threadId)
    {
        \Debugbar::disable();

        $participant = MessengerParticipant::where('thread_id', '=', $threadId)
            ->where('user_id', '=', Auth::id())
            ->first();

        if (! $participant) {
            return response()->json([
                'status_code' => 403,
                'message' => 'Not allowed to access this thread.',
            ], 403);
        }

        $perPage = (int) $request->query('per_page', 50);
        if ($perPage < 1) {
            $perPage = 1;
        }
        if ($perPage > 200) {
            $perPage = 200;
        }

        $messages = MessengerMessage::where('thread_id', '=', $threadId)
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);

        return response()->json([
            'status_code' => 200,
            'message' => 'Messages',
            'data' => $messages->items(),
            'meta' => [
                'page' => $messages->currentPage(),
                'per_page' => $messages->perPage(),
                'total' => $messages->total(),
                'last_page' => $messages->lastPage(),
            ],
        ]);
    }
}
