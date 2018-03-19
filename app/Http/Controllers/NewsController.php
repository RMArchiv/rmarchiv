<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\News;
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
        /*
        $news = \DB::table('news')
            ->leftJoin('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('comments', function ($join) {
                $join->on('comments.content_id', '=', 'news.id');
                $join->on('comments.content_type', '=', \DB::raw("'news'"));
            })
            ->select(['news.id', 'news.title', 'news.user_id', 'users.name', 'news.created_at', 'news.approved', 'news.news_html'])
            ->selectRaw('COUNT(comments.id) as counter')
            ->orderBy('news.created_at', 'desc')
            ->groupBy('news.id')
            ->get();
*/

        $news = News::orderBy('created_at', 'desc')->paginate(25);

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
        if (\Auth::check()) {
            return view('news.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::check()) {
            if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
                $n = new News();
                $n->news_category = $request->get('cat');
                $n->user_id = \Auth::id();
                $n->news_md = $request->get('msg');
                $n->news_html = \Markdown::convertToHtml($request->get('msg'));
                $n->title = $request->get('title');
                $n->approved = 0;

                $n->save();

                return redirect()->action('NewsController@show', $n->id);
            } else {
                return redirect()->action('IndexController@index');
            }
        } else {
            return redirect()->action('IndexController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::whereId($id)->first();

        return view('news.show', [
            'news' => $news,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::check()) {
            if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
                $news = News::whereId($id)->first();

                return view('news.edit', [
                    'news' => $news,
                ]);
            } else {
                return redirect()->action('IndexController@index');
            }
        } else {
            return redirect()->action('IndexController@index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
            $this->validate($request, [
                'title' => 'required',
                'msg'   => 'required',
                'cat'   => 'required',
            ]);

            $news = News::whereId($id)->first();

            $news->title = $request->get('title');
            $news->news_md = $request->get('msg');
            $news->news_html = \Markdown::convertToHtml($request->get('msg'));
            $news->news_category = $request->get('cat');
            $news->save();
        }

        return redirect()->action('NewsController@show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
            $news = News::whereId($id)->first();
            $news->delete();
        }

        return redirect()->action('NewsController@index');
    }

    public function approve($id, $approve)
    {
        if (\Auth::user()->hasRole(['admin', 'owner', 'moderator'])) {
            $news = News::whereId($id)->first();
            $news->approved = $approve;
            $news->save();
        }

        return redirect()->action('NewsController@show', $id);
    }
}
