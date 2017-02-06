<?php

namespace App\Http\Controllers;

use App\Models\BoardThread;
use App\Models\Developer;
use App\Models\News;
use App\Models\User;
use Sitemap;

class SitemapController extends Controller
{
    public function index()
    {
        Sitemap::addSitemap(route('sitemap.users'));
        Sitemap::addSitemap(route('sitemap.games'));
        Sitemap::addSitemap(route('sitemap.developer'));
        Sitemap::addSitemap(route('sitemap.board'));
        Sitemap::addSitemap(route('sitemap.news'));

        return Sitemap::index();
    }

    public function users()
    {
        $users = User::all();

        foreach ($users as $user) {
            Sitemap::addTag(route('users.show', $user->id), $user->created_at, 'monthly', '0.8');
        }

        return Sitemap::render();
    }

    public function games()
    {
        $games = \DB::table('games')
            ->leftJoin('screenshots', 'games.id', '=', 'screenshots.game_id')
            ->where('screenshots.screenshot_id', '=', 1)
            ->get();

        foreach ($games as $game) {
            $tag = Sitemap::addTag(url('games', $game->id), $game->created_at, 'monthly', '0.8');
            $tag->addImage(route('screenshot.show', [$game->id, 1]), 'Titlescreen');
        }

        return Sitemap::render();
    }

    public function developer()
    {
        $dev = Developer::all();

        foreach ($dev as $d) {
            Sitemap::addTag(url('developer', $d->id), $d->created_at, 'monthly', '0.8');
        }

        return Sitemap::render();
    }

    public function board()
    {
        $threads = BoardThread::all();

        foreach ($threads as $thread) {
            Sitemap::addTag(route('board.thread.show', $thread->id), $thread->last_created_at, 'daily', '0.8');
        }

        return Sitemap::render();
    }

    public function news()
    {
        $news = News::all()->where('approved', '=', 1);

        foreach ($news as $new) {
            Sitemap::addTag(url('news', $new->id), $new->created_at, 'monthly', '0.8');
        }

        return Sitemap::render();
    }
}
