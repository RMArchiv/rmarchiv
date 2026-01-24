<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourcesController extends Controller
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

        $query = Resource::query()->orderBy('created_at', 'desc');
        $type = (string) $request->query('type', '');
        $cat = (string) $request->query('cat', '');
        if ($type !== '') {
            $query->where('type', '=', $type);
        }
        if ($cat !== '') {
            $query->where('cat', '=', $cat);
        }

        $resources = $query->paginate($perPage);

        $data = collect($resources->items())->map(function (Resource $resource) {
            return [
                'id' => $resource->id,
                'type' => $resource->type,
                'cat' => $resource->cat,
                'title' => $resource->title,
                'desc_md' => $resource->desc_md,
                'desc_html' => $resource->desc_html,
                'content_type' => $resource->content_type,
                'content_path' => $resource->content_path,
                'votes' => $resource->votes,
                'user_id' => $resource->user_id,
                'created_at' => $resource->created_at,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'Resources',
            'data' => $data,
            'meta' => [
                'page' => $resources->currentPage(),
                'per_page' => $resources->perPage(),
                'total' => $resources->total(),
                'last_page' => $resources->lastPage(),
            ],
        ]);
    }

    public function show($id)
    {
        \Debugbar::disable();

        $resource = Resource::whereId($id)->first();
        if (! $resource) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Resource not found',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Resource',
            'data' => [
                'id' => $resource->id,
                'type' => $resource->type,
                'cat' => $resource->cat,
                'title' => $resource->title,
                'desc_md' => $resource->desc_md,
                'desc_html' => $resource->desc_html,
                'content_type' => $resource->content_type,
                'content_path' => $resource->content_path,
                'votes' => $resource->votes,
                'user_id' => $resource->user_id,
                'created_at' => $resource->created_at,
            ],
        ]);
    }
}
