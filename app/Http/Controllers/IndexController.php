<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
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

        $cdc = \DB::table('games_coupdecoeur')#
            ->orderBy('created_at', 'desc')
            ->first();

        return view('index.index', [
            'news' => $news,
            'shoutbox' => $shoutbox,
            'cdc' => $cdc,
        ]);
    }
}
