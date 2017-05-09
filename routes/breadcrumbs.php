<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('home', action('IndexController@index'));
});

//----------------- Games --------------------------------------------------------------------------------------------//
// Home > Games
Breadcrumbs::register('games', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('games.title'), url('games'));
});

// Home > Games > [game]
Breadcrumbs::register('game', function ($breadcrumbs, $game) {
    $breadcrumbs->parent('games');
    if ($game->subtitle) {
        $breadcrumbs->push($game->title . ' - ' . $game->subtitle, action('GameController@show', $game->id));
    } else {
        $breadcrumbs->push($game->title, action('GameController@show', $game->id));
    }
});

// Home > Games > erstellen
Breadcrumbs::register('game-add', function ($breadcrumbs) {
    $breadcrumbs->parent('games');
    $breadcrumbs->push('erstellen', action('GameController@create'));
});

// Home > Games > [game] > edit
Breadcrumbs::register('game-edit', function ($breadcrumbs, $game) {
    $breadcrumbs->parent('game', $game);
    if ($game->subtitle) {
        $breadcrumbs->push('bearbeiten', action('GameController@edit', $game->id));
    } else {
        $breadcrumbs->push('bearbeiten', action('GameController@edit', $game->id));
    }
});

//----------------- FAQ ----------------------------------------------------------------------------------------------//
// Home > FAQ
Breadcrumbs::register('faq', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('faq.title'), action('FaqController@index'));
});

//----------------- Users --------------------------------------------------------------------------------------------//
// Home > Users
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('user.title'), action('UserController@index'));
});

// Home > Users > [username]
Breadcrumbs::register('user', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->name, action('UserController@show', $user->id));
});

// Home > Users > Online
Breadcrumbs::register('online', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('online', action('UserController@users_online'));
});

//----------------- Board --------------------------------------------------------------------------------------------//
// Home > Board
Breadcrumbs::register('forums', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('forum', action('BoardController@index'));
});

// Home > Board > [Forum]
Breadcrumbs::register('forum', function ($breadcrumbs, $boardcat) {
    $breadcrumbs->parent('forums');
    $breadcrumbs->push($boardcat->title, action('BoardController@show_cat', $boardcat->id));
});

// Home > Board > [Forum] -> [Thread]
Breadcrumbs::register('thread', function ($breadcrumbs, $boardcat, $thread) {
    $breadcrumbs->parent('forum', $boardcat);
    $breadcrumbs->push($thread->title, action('BoardController@show_thread', $thread->id));
});

//----------------- Developers ---------------------------------------------------------------------------------------//
// Home > Developers
Breadcrumbs::register('developers', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('entwickler', action('DeveloperController@index'));
});

//----------------- Pages --------------------------------------------------------------------------------------------//
// Home > Impressum
Breadcrumbs::register('impressum', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('impressum', url('/impressum'));
});

//----------------- Auth --------------------------------------------------------------------------------------------//
// Home -> Login
Breadcrumbs::register('login', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('auth.login'), action('Auth\LoginController@showLoginForm'));
});

//----------------- News ---------------------------------------------------------------------------------------------//
// Home -> Login
Breadcrumbs::register('news', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('news.title'), action('NewsController@index'));
});

//----------------- Awards -------------------------------------------------------------------------------------------//
// Home -> Awards
Breadcrumbs::register('awards', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('awards.title'), action('AwardController@index'));
});

//----------------- Messanger / PN -----------------------------------------------------------------------------------//
// Home -> Messages
Breadcrumbs::register('messages', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('nachrichten', action('MessagesController@index'));
});

// Home > Messages > Erstellen
Breadcrumbs::register('messages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push('nachricht erstellen', action('MessagesController@create'));
});

// Home > Messages > [Msg->Titel]
Breadcrumbs::register('messages.show', function ($breadcrumbs, $thread) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push($thread->subject, action('MessagesController@show', $thread->id));
});