<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        \Debugbar::disable();

        $perPage = (int) $request->query('per_page', 20);
        if ($perPage < 1) {
            $perPage = 1;
        }
        if ($perPage > 100) {
            $perPage = 100;
        }

        $events = Event::orderBy('start_date', 'desc')->paginate($perPage);

        $data = collect($events->items())->map(function (Event $event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'reg_allowed' => (int) $event->reg_allowed,
                'slots' => $event->slots,
                'created_at' => $event->created_at,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'Events',
            'data' => $data,
            'meta' => [
                'page' => $events->currentPage(),
                'per_page' => $events->perPage(),
                'total' => $events->total(),
                'last_page' => $events->lastPage(),
            ],
        ]);
    }

    public function show($id)
    {
        \Debugbar::disable();

        $event = Event::whereId($id)->first();
        if (! $event) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Event not found',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Event',
            'data' => [
                'id' => $event->id,
                'title' => $event->title,
                'description' => $event->description,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'reg_start_date' => $event->reg_start_date,
                'reg_end_date' => $event->reg_end_date,
                'reg_allowed' => (int) $event->reg_allowed,
                'slots' => $event->slots,
                'user_id' => $event->user_id,
                'created_at' => $event->created_at,
            ],
        ]);
    }
}
