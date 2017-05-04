<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('home', action('IndexController@index'));
});

// Home > Games
Breadcrumbs::register('games', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('games.title'), url('games'));
});

// Home > Blog > [game]
Breadcrumbs::register('game', function($breadcrumbs, $game)
{
    $breadcrumbs->parent('games');
    if($game->subtitle){
        $breadcrumbs->push($game->title.' - '.$game->subtitle, action('GameController@show', $game->id));
    }else{
        $breadcrumbs->push($game->title, action('GameController@show', $game->id));
    }
});

// Home > FAQ
Breadcrumbs::register('faq', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('faq.title'), action('FaqController@index'));
});

// Home > Users
Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('user.title'), action('UserController@index'));
});

// Home > Users > Online
Breadcrumbs::register('online', function($breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push('online', action('UserController@users_online'));
});

/*
// Home > Blog > [Category]
Breadcrumbs::register('category', function($breadcrumbs, $category)
{
    $breadcrumbs->parent('blog');
    $breadcrumbs->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Page]
Breadcrumbs::register('page', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('category', $page->category);
    $breadcrumbs->push($page->title, route('page', $page->id));
});
*/