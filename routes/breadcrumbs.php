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

// Home > Games > [game]
Breadcrumbs::register('game', function($breadcrumbs, $game)
{
    $breadcrumbs->parent('games');
    if($game->subtitle){
        $breadcrumbs->push($game->title.' - '.$game->subtitle, action('GameController@show', $game->id));
    }else{
        $breadcrumbs->push($game->title, action('GameController@show', $game->id));
    }
});

// Home > Games > erstellen
Breadcrumbs::register('game-add', function($breadcrumbs){
    $breadcrumbs->parent('games');
    $breadcrumbs->push('erstellen', action('GameController@create'));
});

// Home > Games > [game] > edit
Breadcrumbs::register('game-edit', function($breadcrumbs, $game)
{
    $breadcrumbs->parent('game', $game);
    if($game->subtitle){
        $breadcrumbs->push('bearbeiten', action('GameController@edit', $game->id));
    }else{
        $breadcrumbs->push('bearbeiten', action('GameController@edit', $game->id));
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

// Home > Board
Breadcrumbs::register('forums', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('forum', action('BoardController@index'));
});

// Home > Board > [Forum]
Breadcrumbs::register('forum', function($breadcrumbs, $boardcat)
{
    $breadcrumbs->parent('forums');
    $breadcrumbs->push($boardcat->title, action('BoardController@show_cat', $boardcat->id));
});

// Home > Board > [Forum] -> [Thread]
Breadcrumbs::register('thread', function($breadcrumbs, $boardcat, $thread)
{
    $breadcrumbs->parent('forum', $boardcat);
    $breadcrumbs->push($thread->title, action('BoardController@show_thread', $thread->id));
});