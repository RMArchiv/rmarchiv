<?php

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Helpers\DatabaseHelper;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ResourceController extends Controller
{
    public function index(){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->limit(20)
            ->get();

        return view('resources.index',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_gfx(){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.type', '=', 'gfx')
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->limit(20)
            ->get();

        return view('resources.gfx.index',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_sfx(){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.type', '=', 'sfx')
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->limit(20)
            ->get();

        return view('resources.sfx.index',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_scripts(){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.type', '=', 'scripts')
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->limit(20)
            ->get();

        return view('resources.scripts.index',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_tools(){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.type', '=', 'tools')
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->limit(20)
            ->get();

        return view('resources.tools.index',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);    }

    public function index_gfx_cat($cat){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.type', '=', 'gfx')
            ->where('resources.cat', '=', $cat)
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->get();

        return view('resources.gfx.index_cat',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_sfx_cat($cat){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.type', '=', 'sfx')
            ->where('resources.cat', '=', $cat)
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->get();

        return view('resources.sfx.index_cat',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_scripts_cat($cat){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.type', '=', 'scripts')
            ->where('resources.cat', '=', $cat)
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->get();

        return view('resources.scripts.index_cat',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function index_tools_cat($cat){
        $res = \DB::table('resources')
            ->leftJoin('users', 'users.id', '=', 'resources.user_id')
            ->leftJoin('comments', function($join){
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
                'resources.content_type as contenttype'
            ])
            ->selectRaw('COUNT(comments.id) AS commentcount')
            ->selectRaw('SUM(comments.vote_up) AS voteup')
            ->selectRaw('SUM(comments.vote_down) AS votedown')
            ->selectRaw('(SUM(comments.vote_up) - SUM(comments.vote_down) / (SUM(comments.vote_up) + SUM(comments.vote_down))) AS voteavg ')
            ->where('resources.type', '=', 'tools')
            ->where('resources.cat', '=', $cat)
            ->groupBy('resources.id')
            ->orderBy('resources.created_at', 'desc')
            ->get();

        return view('resources.tools.index_cat',[
            'resources' => $res,
            'commentsmax' => DatabaseHelper::getCommentsMax('resource'),
        ]);
    }

    public function show($type, $cat, $id){
        $resource = \DB::table('resources')
            ->leftJoin('users', 'resources.user_id', '=', 'users.id')
            ->leftJoin('comments', function($join){
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
                'users.id as userid'
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
                'comments.vote_up', 'comments.vote_down'])
            ->where('content_type', '=', \DB::raw("'resource'"))
            ->where('content_id', '=', $id)
            ->orderBy('created_at', 'asc')->get();

        return view('resources.show', [
            'resource' => $resource,
            'comments' => $comments,
        ]);
    }

    public function create(){
        return view('resources.create');
    }

    public function create_steps(Request $request){
        return view('resources.create', [
            'request' => $request,
        ]);

    }

    public function store(Request $request){
        $this->validate($request, [
            'step' => 'required',
            'type' => 'required|not_in:0',
            'cat' => 'required|not_in:0',
            'title' => 'required',
            'desc' => 'required',
            'content_type' => 'required'
        ]);

        $content_path = '';

        if($request->get('content_type') == 'url'){
            if(filter_var($request->get('url'), FILTER_VALIDATE_URL)){
                $content_path = $request->get('url');
            }else{
                return back()->withInput();
            }
        }else{
            $storagetemp = 'temp/'.$request->get('uuid').'/file';
            $storagedest = 'resources/'.$request->get('uuid').'.'.$request->get('ext');

            $exists = \Storage::disk('local')->exists($storagetemp);
            if($exists === true) {
                \Storage::move($storagetemp, $storagedest);
            }else{
                return back()->withInput();
            }

            $content_path = $storagedest;
        }

        \DB::table('resources')->insert([
            'type' => $request->get('type'),
            'cat' => $request->get('cat'),
            'user_id' => \Auth::id(),
            'title' => $request->get('title'),
            'desc_md' => $request->get('desc'),
            'desc_html' => \Markdown::convertToHtml($request->get('desc')),
            'content_type' => $request->get('content_type'),
            'content_path' => $content_path,
            'created_at' => Carbon::now(),
        ]);

        event(new Obyx('resource-add', \Auth::id()));

        return redirect()->route('resources');
    }

}
