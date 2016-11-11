<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $news = \DB::table('news')
            ->leftJoin('users', 'news.user_id', '=', 'users.id')
            ->select(['news.id', 'news.title', 'news.user_id', 'users.name', 'news.created_at', 'news.approved', 'news.news_html'])
            ->where('news.approved', '=', 1)
            ->orderBy('news.created_at', 'desc')
            ->get()->take(5);

        return view('index.index', [
            'news' => $news,
        ]);
    }
}
