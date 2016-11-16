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

        $shoutbox = \DB::table('shoutbox')
            ->select([
                'users.id as userid',
                'users.name as username',
                'shoutbox.shout_html as shouthtml',
                'shoutbox.created_at as shoutcreated_at'
            ])
            ->leftJoin('users', 'shoutbox.user_id', '=', 'users.id')
            ->orderBy('shoutbox.created_at', 'desc')
            ->limit(5)
            ->get()
            ->reverse();

        return view('index.index', [
            'news' => $news,
            'shoutbox' => $shoutbox,
        ]);
    }
}
