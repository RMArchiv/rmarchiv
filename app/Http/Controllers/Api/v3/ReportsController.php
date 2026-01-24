<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\UserReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.token');
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

        $reports = UserReport::where('user_id', '=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status_code' => 200,
            'message' => 'Reports',
            'data' => $reports->items(),
            'meta' => [
                'page' => $reports->currentPage(),
                'per_page' => $reports->perPage(),
                'total' => $reports->total(),
                'last_page' => $reports->lastPage(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        \Debugbar::disable();

        $type = (string) $request->input('type', '');
        $contentId = (int) $request->input('id', 0);
        $reason = trim((string) $request->input('reason', ''));
        $allowed = ['game', 'comment', 'news', 'resource', 'event'];

        if ($contentId <= 0 || ! in_array($type, $allowed, true) || $reason === '') {
            return response()->json([
                'status_code' => 422,
                'message' => 'type, id and reason are required.',
            ], 422);
        }

        $report = UserReport::create([
            'user_id' => Auth::id(),
            'content_id' => $contentId,
            'content_type' => $type,
            'reason' => $reason,
            'closed' => 0,
        ]);

        return response()->json([
            'status_code' => 201,
            'message' => 'Report created',
            'data' => $report,
        ], 201);
    }
}
