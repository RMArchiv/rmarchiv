<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Resource;
use Carbon\Carbon;
use App\Events\Obyx;
use Illuminate\Http\Request;
use App\Helpers\DatabaseHelper;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        return view('resources.index', [
            'resources'   => $this->getResourceListing($request),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
            'title'       => trans('app.resources_overview'),
        ]);
    }

    public function index_gfx(Request $request)
    {
        return view('resources.gfx.index', [
            'resources'   => $this->getResourceListing($request, 'gfx'),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_sfx(Request $request)
    {
        return view('resources.sfx.index', [
            'resources'   => $this->getResourceListing($request, 'sfx'),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_scripts(Request $request)
    {
        return view('resources.scripts.index', [
            'resources'   => $this->getResourceListing($request, 'scripts'),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_tools(Request $request)
    {
        return view('resources.tools.index', [
            'resources'   => $this->getResourceListing($request, 'tools'),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_gfx_cat(Request $request, $cat)
    {
        return view('resources.gfx.index_cat', [
            'resources'   => $this->getResourceListing($request, 'gfx', $cat),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_sfx_cat(Request $request, $cat)
    {
        return view('resources.sfx.index_cat', [
            'resources'   => $this->getResourceListing($request, 'sfx', $cat),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_scripts_cat(Request $request, $cat)
    {
        return view('resources.scripts.index_cat', [
            'resources'   => $this->getResourceListing($request, 'scripts', $cat),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_tools_cat(Request $request, $cat)
    {
        return view('resources.tools.index_cat', [
            'resources'   => $this->getResourceListing($request, 'tools', $cat),
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    private function getResourceListing(Request $request, ?string $type = null, ?string $category = null)
    {
        $sort = $request->query('sort', 'created_at');
        $direction = strtolower($request->query('direction', 'desc')) === 'asc' ? 'asc' : 'desc';

        $sortMap = [
            'type' => 'resources.type',
            'category' => 'resources.cat',
            'author' => 'users.name',
            'created_at' => 'resources.created_at',
            'title' => 'resources.title',
            'content_type' => 'resources.content_type',
            'upvotes' => 'voteup',
            'downvotes' => 'votedown',
            'rating' => 'voteavg',
            'popularity' => 'commentcount',
            'comments' => 'commentcount',
        ];

        if (! array_key_exists($sort, $sortMap)) {
            $sort = 'created_at';
        }

        $query = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function ($join) {
                $join->on('comments.content_id', '=', 'resources.id');
                $join->on('comments.content_type', '=', \DB::raw("'resource'"));
            })
            ->select([
                'resources.id as resid',
                'resources.type as restype',
                'resources.cat as rescat',
                'resources.user_id as userid',
                'users.name as username',
                'resources.title as restitle',
                'resources.created_at as rescreatedat',
                'resources.content_type as contenttype',
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('COALESCE(SUM(comments.vote_up), 0) AS voteup')
            ->selectRaw('COALESCE(SUM(comments.vote_down), 0) AS votedown')
            ->selectRaw('(COALESCE(SUM(comments.vote_up), 0) - COALESCE(SUM(comments.vote_down), 0)) / NULLIF((COALESCE(SUM(comments.vote_up), 0) + COALESCE(SUM(comments.vote_down), 0)), 0) AS voteavg')
            ->groupBy([
                'resources.id',
                'resources.type',
                'resources.cat',
                'resources.user_id',
                'users.name',
                'resources.title',
                'resources.created_at',
                'resources.content_type',
            ]);

        if ($type !== null) {
            $query->where('resources.type', '=', $type);
        }

        if ($category !== null) {
            $query->where('resources.cat', '=', $category);
        }

        $query->orderBy($sortMap[$sort], $direction);
        if ($sort !== 'created_at') {
            $query->orderBy('resources.created_at', 'desc');
        }

        return $query->paginate(25)->withQueryString();
    }

    public function show($type, $cat, $id)
    {
        $resource = \DB::table('resources')
            ->leftJoin('users', 'resources.user_id', '=', 'users.id')
            ->leftJoin('comments', function ($join) {
                $join->on('comments.content_id', '=', 'resources.id');
                $join->on('comments.content_type', '=', \DB::raw("'resource'"));
            })
            ->select([
                'resources.id as id',
                'resources.type as type',
                'resources.cat as cat',
                'resources.title as title',
                'resources.desc_html as desc_html',
                'resources.created_at as created_at',
                'resources.content_type as content_type',
                'resources.content_path as content_path',
                'users.name as username',
                'users.id as userid',
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.id', '=', $id)
            ->where('resources.cat', '=', $cat)
            ->where('resources.type', '=', $type)
            ->first();

        $comments = \DB::table('comments')
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->select(['comments.id', 'comments.user_id', 'comments.comment_html', 'comments.created_at', 'users.name',
                'comments.vote_up', 'comments.vote_down', ])
            ->where('content_type', '=', \DB::raw("'resource'"))
            ->where('content_id', '=', $id)
            ->orderBy('created_at', 'asc')->get();

        return view('resources.show', [
            'resource' => $resource,
            'comments' => $comments,
        ]);
    }

    public function create()
    {
        return view('resources.create');
    }

    public function create_steps(Request $request)
    {
        return view('resources.create', [
            'request' => $request,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'step'         => 'required',
            'type'         => 'required|not_in:0',
            'cat'          => 'required|not_in:0',
            'title'        => 'required',
            'desc'         => 'required',
            'content_type' => 'required',
        ]);

        if ($request->get('content_type') == 'url') {
            if (filter_var($request->get('url'), FILTER_VALIDATE_URL)) {
                $content_path = $request->get('url');
            } else {
                return back()->withInput();
            }
        } else {
            $storagetemp = 'temp/'.$request->get('uuid').'/file';
            $storagedest = 'resources/'.$request->get('uuid').'.'.$request->get('ext');

            $exists = \Storage::disk('local')->exists($storagetemp);
            if ($exists === true) {
                \Storage::move($storagetemp, $storagedest);
            } else {
                return back()->withInput();
            }

            $content_path = $storagedest;
        }

        $res = new Resource();
        $res->type = $request->get('type');
        $res->cat = $request->get('cat');
        $res->user_id = \Auth::id();
        $res->title = $request->get('title');
        $res->desc_md = $request->get('msg');
        $res->desc_html = \Markdown::convert($request->get('msg'));
        $res->content_path = $content_path;
        $res->content_type = $request->get('content_type');
        $res->save();

        event(new Obyx('resource-add', \Auth::id()));

        return redirect()->route('resources');
    }
}
