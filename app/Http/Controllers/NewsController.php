<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\UserSetting;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = \DB::table('news')
            ->leftJoin('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('comments', function($join){
                $join->on('comments.content_id', '=', 'news.id');
                $join->on('comments.content_type', '=', \DB::raw("'news'"));
            })
            ->select(['news.id', 'news.title', 'news.user_id', 'users.name', 'news.created_at', 'news.approved', 'news.news_html'])
            ->selectRaw('COUNT(comments.id) as counter')
            ->orderBy('news.created_at', 'desc')
            ->groupBy('news.id')
            ->get();

        return view('news.index', [
            'news' => $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $n = new News;
        $n->news_category = $request->get('cat');
        $n->user_id = \Auth::id();
        $n->news_md = $request->get('msg');
        $n->news_html = \Markdown::convertToHtml($request->get('msg'));
        $n->title = $request->get('title');
        $n->approved = 0;

        $n->save();

        return redirect()->action('NewsController@show', $n->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::check()){
            if(UserSetting::whereUserId(\Auth::id())->first()->is_admin = 1){
                $news = \DB::table('news')
                    ->leftJoin('users', 'news.user_id', '=', 'users.id')
                    ->select(['news.id', 'news.title', 'news.news_html', 'news_category', 'users.name', 'news.user_id', 'news.created_at', 'news.approved'])
                    ->where('news.id', '=', $id)
                    ->first();
            }else{
                $news = \DB::table('news')
                    ->leftJoin('users', 'news.user_id', '=', 'users.id')
                    ->select(['news.id', 'news.title', 'news.news_html', 'news_category', 'users.name', 'news.user_id', 'news.created_at', 'news.approved'])
                    ->where('news.id', '=', $id)
                    ->where('approved', '=', '1')
                    ->first();
            }
        }else{
            $news = \DB::table('news')
                ->leftJoin('users', 'news.user_id', '=', 'users.id')
                ->select(['news.id', 'news.title', 'news.news_html', 'news_category', 'users.name', 'news.user_id', 'news.created_at', 'news.approved'])
                ->where('news.id', '=', $id)
                ->where('approved', '=', '1')
                ->first();
        }

        $content_type = 'news';

        $comments = \DB::table('comments')
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->select(['comments.id', 'comments.user_id', 'comments.comment_html', 'comments.created_at', 'users.name',
            'comments.vote_up', 'comments.vote_down'])
            ->where('content_type', '=', $content_type)
            ->where('content_id', '=', $id)
            ->orderBy('created_at', 'asc')->get();


        return view('news.show', [
            'news' => $news,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::whereId($id)->first();

        return view('news.edit', [
            'news' => $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'msg' => 'required',
            'cat' => 'required',
        ]);

        $news = News::whereId($id)->first();

        $news->title = $request->get('title');
        $news->news_md = $request->get('msg');
        $news->news_html = \Markdown::convertToHtml($request->get('msg'));
        $news->news_category = $request->get('cat');
        $news->save();

        return redirect()->action('NewsController@show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::whereId($id)->first();
        $news->delete();

        return redirect()->action('NewsController@index');
    }

    public function approve($id, $approve){
        $news = News::whereId($id)->first();
        $news->approved = $approve;
        $news->save();

        return redirect()->action('NewsController@show', $id);
    }
}
