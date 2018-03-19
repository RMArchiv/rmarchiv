<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Sitemap;
use App\Models\Game;
use App\Models\News;
use App\Models\User;
use App\Models\Developer;
use App\Models\BoardThread;

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
        $games = Game::all();

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
