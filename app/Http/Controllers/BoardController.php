<?php

namespace App\Http\Controllers;

use App\Events\Obyx;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(){
        $cats = \DB::table('board_cats')
            ->orderBy('order')
            ->get();

        $threads = array();

        foreach ($cats as $cat){
            $thr = \DB::table('board_threads')
                ->leftJoin('users as usercreate', 'board_threads.user_id', '=', 'usercreate.id')
                ->leftJoin('users as userlast', 'board_threads.last_user_id', '=', 'userlast.id')
                ->select([
                    'board_threads.id as threadid',
                    'board_threads.title as threadtitle',
                    'usercreate.id as usercreateid',
                    'usercreate.name as usercreatename',
                    'userlast.id as userlastid',
                    'userlast.name as userlastname',
                    'board_threads.created_at as threaddate',
                    'board_threads.last_created_at as lastdate',
                ])
                ->selectRaw('(SELECT COUNT(*) FROM board_posts WHERE board_posts.thread_id = board_threads.id) as posts')
                ->where('board_threads.cat_id', '=', $cat->id)
                ->orderBy('board_threads.last_created_at', 'desc')
                ->orderBy('board_threads.id', 'desc')
                ->limit(10)
                ->get();

            $threads[$cat->id] = $thr;
        }

        return view('board.index', [
            'cats' => $cats,
            'threads' => $threads,
        ]);
    }

    public function show_cat($catid){
        $thr = \DB::table('board_threads')
            ->leftJoin('users as usercreate', 'board_threads.user_id', '=', 'usercreate.id')
            ->leftJoin('users as userlast', 'board_threads.last_user_id', '=', 'userlast.id')
            ->leftJoin('board_cats as bc', 'board_threads.cat_id', '=', 'bc.id')
            ->select([
                'board_threads.id as threadid',
                'board_threads.title as threadtitle',
                'usercreate.id as usercreateid',
                'usercreate.name as usercreatename',
                'userlast.id as userlastid',
                'userlast.name as userlastname',
                'board_threads.created_at as threaddate',
                'board_threads.last_created_at as lastdate',
                'bc.title as cattitle',
                'bc.id as catid'
            ])
            ->selectRaw('(SELECT COUNT(*) FROM board_posts WHERE board_posts.thread_id = board_threads.id) as posts')
            ->where('board_threads.cat_id', '=', $catid)
            ->orderBy('board_threads.last_created_at', 'desc')
            ->orderBy('board_threads.id', 'desc')
            ->get();

        return view('board.threads.index', [
            'threads' => $thr,
        ]);
    }

    public function create_cat(){

        $cats = \DB::table('board_cats')
            ->select([
                'id as catid',
                'title as cattitle',
                'order as catorder',
                'created_at as catdate',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM board_threads WHERE cat_id = board_cats.id) as catthreads')
            ->selectRaw('(SELECT COUNT(id) FROM board_posts WHERE cat_id = board_cats.id) as catposts')
            ->orderBy('board_cats.order')
            ->get();

        return view('board.cats.create', [
            'cats' => $cats,
        ]);
    }

    public function order_cat($catid, $direction){
        if($direction == 'up'){
            \DB::table('board_cats')
                ->where('id', '=', $catid)
                ->increment('order');
        }else{
            \DB::table('board_cats')
                ->where('id', '=', $catid)
                ->decrement('order');
        }

        return redirect()->action('BoardController@create_cat');
    }

    public function store_cat(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
        ]);

        \DB::table('board_cats')->insert([
            'order' => 0,
            'title' => $request->get('name'),
            'desc' => $request->get('desc'),
            'created_at' => \Auth::id(),
        ]);

        return redirect()->action('BoardController@create_cat');
    }

    public function show_thread($threadid){

        $posts = \DB::table('board_posts as p')
            ->leftJoin('board_threads as t', 'p.thread_id', '=', 't.id')
            ->leftjoin('board_cats as c', 'p.cat_id', '=', 'c.id')
            ->leftJoin('users as u', 'p.user_id', '=', 'u.id')
            ->select([
                'p.id as pid',
                'u.id as uid',
                'p.cat_id as pcatid',
                'p.content_md as pcontent_md',
                'p.content_html as pcontent_html',
                'p.created_at as pdate',
                't.id as tid',
                't.title as ttitle',
                'c.title as ctitle',
                'u.name as uname',
                'c.id as cid'
            ])
            ->where('p.thread_id', '=', $threadid)
            ->orderBy('p.id', 'asc')
            ->get();

        return view('board.threads.show', [
            'posts' => $posts,
        ]);
    }

    public function create_thread($catid){

    }

    public function store_thread(Request $request){
        $date = Carbon::now();

        $threadid = \DB::table('board_threads')->insertGetId([
            'cat_id' => $request->get('category'),
            'user_id' => \Auth::id(),
            'title' => $request->get('topic'),
            'closed' => 0,
            'pinned' => 0,
            'last_user_id' => \Auth::id(),
            'created_at' => $date,
            'last_created_at' => $date,
        ]);

        event(new Obyx('thread-add', \Auth::id()));

        \DB::table('board_posts')->insert([
            'cat_id' => $request->get('category'),
            'thread_id' => $threadid,
            'user_id' => \Auth::id(),
            'content_md' => $request->get('message'),
            'content_html' => \Markdown::convertToHtml($request->get('message')),
            'created_at' => $date,
        ]);

        return redirect()->action('BoardController@show_thread', [$threadid]);
    }

    public function store_post(Request $request, $threadid){
        $this->validate($request, [
            'catid' => 'required',
            'message' => 'required',
        ]);

        $date = Carbon::now();

        $pid = \DB::table('board_posts')->insertGetId([
            'user_id' => \Auth::id(),
            'cat_id' => $request->get('catid'),
            'thread_id' => $threadid,
            'content_md' => $request->get('message'),
            'content_html' => \Markdown::convertToHtml($request->get('message')),
            'created_at' => $date,
        ]);

        \DB::table('board_threads')
            ->where('id', '=', $threadid)
            ->update([
                'last_created_at' => $date,
                'last_user_id' => \Auth::id(),
            ]);

        \DB::table('board_cats')
            ->where('id', '=', $request->get('catid'))
            ->update([
                'last_created_at' => $date,
                'last_user_id' => \Auth::id(),
            ]);

        $url = \URL::route('board.thread.show', [$threadid]).'#c'.$pid;

        event(new Obyx('post-add', \Auth::id()));

        return redirect()->to($url);
    }
}
