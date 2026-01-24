<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;

class LogosController extends Controller
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

        $logos = Logo::orderBy('created_at', 'desc')->paginate($perPage);

        $data = collect($logos->items())->map(function (Logo $logo) {
            return [
                'id' => $logo->id,
                'title' => $logo->title,
                'user_id' => $logo->user_id,
                'created_at' => $logo->created_at,
                'image_url' => route('logo.show', ['id' => $logo->id]),
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'Logos',
            'data' => $data,
            'meta' => [
                'page' => $logos->currentPage(),
                'per_page' => $logos->perPage(),
                'total' => $logos->total(),
                'last_page' => $logos->lastPage(),
            ],
        ]);
    }

    public function show($id)
    {
        \Debugbar::disable();

        $logo = Logo::whereId($id)->first();
        if (! $logo) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Logo not found',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Logo',
            'data' => [
                'id' => $logo->id,
                'title' => $logo->title,
                'user_id' => $logo->user_id,
                'created_at' => $logo->created_at,
                'image_url' => route('logo.show', ['id' => $logo->id]),
            ],
        ]);
    }
}
