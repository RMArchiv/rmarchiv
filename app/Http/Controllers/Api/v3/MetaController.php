<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\License;
use App\Models\Maker;
use App\Models\Tag;

class MetaController extends Controller
{
    public function tags()
    {
        \Debugbar::disable();

        $tags = Tag::orderBy('title')->get(['id', 'title']);

        return response()->json([
            'status_code' => 200,
            'message' => 'Tags',
            'data' => $tags,
        ]);
    }

    public function makers()
    {
        \Debugbar::disable();

        $makers = Maker::orderBy('title')->get(['id', 'title', 'short']);

        return response()->json([
            'status_code' => 200,
            'message' => 'Makers',
            'data' => $makers,
        ]);
    }

    public function languages()
    {
        \Debugbar::disable();

        $languages = Language::orderBy('name')->get(['id', 'name', 'short']);

        return response()->json([
            'status_code' => 200,
            'message' => 'Languages',
            'data' => $languages,
        ]);
    }

    public function licenses()
    {
        \Debugbar::disable();

        $licenses = License::orderBy('title')->get(['id', 'title', 'short']);

        return response()->json([
            'status_code' => 200,
            'message' => 'Licenses',
            'data' => $licenses,
        ]);
    }
}
