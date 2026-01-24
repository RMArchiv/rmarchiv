<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDownloadLog;
use App\Models\UserOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.token')->only(['me', 'downloads']);
    }

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

        $users = User::select(['id', 'name', 'created_at'])
            ->orderBy('name')
            ->paginate($perPage);

        return response()->json([
            'status_code' => 200,
            'message' => 'Users',
            'data' => $users->items(),
            'meta' => [
                'page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
                'last_page' => $users->lastPage(),
            ],
        ]);
    }

    public function show($id)
    {
        \Debugbar::disable();

        $user = User::select(['id', 'name', 'created_at'])->whereId($id)->first();
        if (! $user) {
            return response()->json([
                'status_code' => 404,
                'message' => 'User not found',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'User',
            'data' => $user,
        ]);
    }

    public function me()
    {
        \Debugbar::disable();

        $user = Auth::user();

        return response()->json([
            'status_code' => 200,
            'message' => 'Current user',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ],
        ]);
    }

    public function downloads(Request $request)
    {
        \Debugbar::disable();

        $perPage = (int) $request->query('per_page', 50);
        if ($perPage < 1) {
            $perPage = 1;
        }
        if ($perPage > 200) {
            $perPage = 200;
        }

        $downloads = UserDownloadLog::whereUserId(Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status_code' => 200,
            'message' => 'Download log',
            'data' => $downloads->items(),
            'meta' => [
                'page' => $downloads->currentPage(),
                'per_page' => $downloads->perPage(),
                'total' => $downloads->total(),
                'last_page' => $downloads->lastPage(),
            ],
        ]);
    }

    public function online()
    {
        \Debugbar::disable();

        $online = UserOnline::with('user')
            ->where('created_at', '>=', now()->subMinutes(10))
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function (UserOnline $entry) {
                return [
                    'id' => $entry->id,
                    'user' => $entry->user ? [
                        'id' => $entry->user->id,
                        'name' => $entry->user->name,
                    ] : null,
                    'last_place' => $entry->last_place,
                    'created_at' => $entry->created_at,
                ];
            });

        return response()->json([
            'status_code' => 200,
            'message' => 'Online users',
            'data' => $online,
        ]);
    }
}
