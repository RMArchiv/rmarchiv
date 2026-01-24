<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
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

        $news = News::where('approved', '=', 1)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $data = collect($news->items())->map(function (News $item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'news_md' => $item->news_md,
                'news_html' => $item->news_html,
                'news_category' => $item->news_category,
                'user_id' => $item->user_id,
                'created_at' => $item->created_at,
            ];
        });

        return response()->json([
            'status_code' => 200,
            'message' => 'News',
            'data' => $data,
            'meta' => [
                'page' => $news->currentPage(),
                'per_page' => $news->perPage(),
                'total' => $news->total(),
                'last_page' => $news->lastPage(),
            ],
        ]);
    }

    public function show($id)
    {
        \Debugbar::disable();

        $news = News::where('approved', '=', 1)->whereId($id)->first();
        if (! $news) {
            return response()->json([
                'status_code' => 404,
                'message' => 'News not found',
            ], 404);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'News item',
            'data' => [
                'id' => $news->id,
                'title' => $news->title,
                'news_md' => $news->news_md,
                'news_html' => $news->news_html,
                'news_category' => $news->news_category,
                'user_id' => $news->user_id,
                'created_at' => $news->created_at,
            ],
        ]);
    }
}
