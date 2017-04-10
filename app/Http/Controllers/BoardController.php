<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\BoardPollAnswer;
use Carbon\Carbon;
use App\Events\Obyx;
use App\Models\BoardCat;
use App\Models\BoardPoll;
use App\Models\BoardPost;
use App\Models\BoardThread;
use Illuminate\Http\Request;
use App\Helpers\DatabaseHelper;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\Input;

class BoardController extends Controller
{
    public function index()
    {
        $cats = BoardCat::with('last_user', 'threads')->orderBy('order')->get();

        return view('board.index', [
            'cats' => $cats,
        ]);
    }

    public function show_cat($catid)
    {
        $thr = BoardThread::with('user', 'cat', 'last_user', 'posts')
            ->whereCatId($catid)
            ->orderBy('board_threads.pinned', 'desc')
            ->orderBy('board_threads.last_created_at', 'desc')
            ->orderBy('board_threads.id', 'desc')
            ->get();

        return view('board.threads.index', [
            'threads' => $thr,
        ]);
    }

    public function create_cat()
    {
        if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
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
    }

    public function order_cat($catid, $direction)
    {
        if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
            if ($direction == 'up') {
                \DB::table('board_cats')
                    ->where('id', '=', $catid)
                    ->increment('order');
            } else {
                \DB::table('board_cats')
                    ->where('id', '=', $catid)
                    ->decrement('order');
            }
        }

        return redirect()->action('BoardController@create_cat');
    }

    public function store_cat(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
        ]);

        if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
            \DB::table('board_cats')->insert([
                'order'      => 0,
                'title'      => $request->get('name'),
                'desc'       => $request->get('desc'),
                'created_at' => \Auth::id(),
            ]);
        }

        return redirect()->action('BoardController@create_cat');
    }

    public function show_thread($threadid)
    {
        $posts = BoardPost::with('user', 'thread', 'cat')->whereThreadId($threadid)->orderBy('id')->paginate(25);

        DatabaseHelper::setThreadViewDate($threadid);

        if (! Input::get('page')) {
            return redirect('board/thread/'.$threadid.'?page='.$posts->lastPage());
        } else {
            return view('board.threads.show', [
                'posts' => $posts,
            ]);
        }
    }

    public function store_thread(Request $request)
    {
        $date = Carbon::now();

        $threadid = \DB::table('board_threads')->insertGetId([
            'cat_id'          => $request->get('category'),
            'user_id'         => \Auth::id(),
            'title'           => $request->get('topic'),
            'closed'          => 0,
            'pinned'          => 0,
            'last_user_id'    => \Auth::id(),
            'created_at'      => $date,
            'last_created_at' => $date,
        ]);

        event(new Obyx('thread-add', \Auth::id()));

        \DB::table('board_posts')->insert([
            'cat_id'       => $request->get('category'),
            'thread_id'    => $threadid,
            'user_id'      => \Auth::id(),
            'content_md'   => $request->get('msg'),
            'content_html' => \Markdown::convertToHtml($request->get('msg')),
            'created_at'   => $date,
        ]);

        DatabaseHelper::setThreadViewDate($threadid);

        return redirect()->action('BoardController@show_thread', [$threadid]);
    }

    public function store_post(Request $request, $threadid)
    {
        $this->validate($request, [
            'catid'   => 'required',
            'msg' => 'required',
        ]);

        $check = BoardThread::whereId($threadid)->first();
        if ($check->closed == 0) {
            $date = Carbon::now();

            $pid = \DB::table('board_posts')->insertGetId([
                'user_id'      => \Auth::id(),
                'cat_id'       => $request->get('catid'),
                'thread_id'    => $threadid,
                'content_md'   => $request->get('msg'),
                'content_html' => \Markdown::convertToHtml($request->get('msg')),
                'created_at'   => $date,
            ]);

            \DB::table('board_threads')
                ->where('id', '=', $threadid)
                ->update([
                    'last_created_at' => $date,
                    'last_user_id'    => \Auth::id(),
                ]);

            \DB::table('board_cats')
                ->where('id', '=', $request->get('catid'))
                ->update([
                    'last_created_at' => $date,
                    'last_user_id'    => \Auth::id(),
                ]);

            event(new Obyx('post-add', \Auth::id()));

            $url = \URL::route('board.thread.show', [$threadid]).'#c'.$pid;
        } else {
            $url = \URL::route('board.thread.show', [$threadid]);
        }

        return redirect()->to($url);
    }

    public function thread_close_switch($id, $state)
    {
        if (\Auth::check()) {
            if (\Auth::user()->can('mod-threads')) {
                if (is_numeric($id)) {
                    if ($state == 1 || $state == 0) {
                        \DB::table('board_threads')
                            ->where('id', '=', $id)
                            ->update([
                                'closed' => $state,
                            ]);
                    }
                }
            }
        }

        return redirect()->action('BoardController@show_thread', $id);
    }

    public function post_edit($threadid, $postid)
    {
        $post = BoardPost::whereId($postid)->first();

        return view('board.post.edit', [
            'post' => $post,
        ]);
    }

    public function post_update(Request $request, $threadid, $postid)
    {
        if (\Auth::check()) {
            $this->validate($request, [
                'thread_id' => 'required',
                'post_id'   => 'required',
                'msg'       => 'required',
            ]);

            $post = BoardPost::whereId($postid)->first();
            $post->content_md = $request->get('msg');
            $post->content_html = \Markdown::convertToHtml($request->get('msg'));
            $post->save();
        }

        return redirect()->action('BoardController@show_thread', $threadid);
    }

    public function create_vote($threadid)
    {
        $check = BoardPoll::whereThreadId($threadid)->get();
        $thread = BoardThread::whereId($threadid)->first();

        $edit = 0;

        if ($check) {
            $edit = 1;
        }

        return view('board.threads.vote', [
            'edit' => $edit,
            'thread_id' => $threadid,
            'thread' => $thread,
        ]);
    }

    public function store_vote(Request $request, $threadid)
    {
        $this->validate($request, [
            'thread_id' => 'required',
            'question'  => 'required',
            'answer0'   => 'required',
            'answer1'   => 'required',
        ]);

        $poll = new BoardPoll;
        $poll->user_id = \Auth::id();
        $poll->title = $request->get('question');
        $poll->save();

        for($i = 0; $i < 10; $i++){
            $pollAnswers = new BoardPollAnswer;
            $pollAnswers->title = $request->get('answer'.$i);
            $pollAnswers->user_id = \Auth::id();
            $pollAnswers->poll_id = $poll->id;
            $pollAnswers->save();
        }

        return redirect()->action('BoardController@show_thread', $threadid);
    }

    public function add_vote(Request $request){

    }

    public function update_vote(Request $request, $threadid)
    {
    }
}
