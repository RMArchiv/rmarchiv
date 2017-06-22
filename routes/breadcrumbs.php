<?php

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push(trans('app.home'), action('IndexController@index'));
});

//----------------- Games --------------------------------------------------------------------------------------------//
// Home > Games
Breadcrumbs::register('games', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.games'), url('games'));
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
    $breadcrumbs->push(trans('app.add_game'), action('GameController@create'));
});

// Home > Games > [game] > edit
Breadcrumbs::register('game-edit', function ($breadcrumbs, $game) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.edit_game'), action('GameController@edit', $game->id));
});

//----------------- FAQ ----------------------------------------------------------------------------------------------//
// Home > FAQ
Breadcrumbs::register('faq', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.faq'), action('FaqController@index'));
});

//----------------- Users --------------------------------------------------------------------------------------------//
// Home > Users
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.users'), action('UserController@index'));
});

// Home > Users > [username]
Breadcrumbs::register('user', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->name, action('UserController@show', $user->id));
});

// Home > Users > Online
Breadcrumbs::register('online', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('app.users_online'), action('UserController@users_online'));
});

//----------------- Board --------------------------------------------------------------------------------------------//
// Home > Board
Breadcrumbs::register('forums', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.board'), action('BoardController@index'));
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

// Home > Board > [Forum] -> [Thread] -> edit
Breadcrumbs::register('post.edit', function ($breadcrumbs, $boardcat, $post) {
    $breadcrumbs->parent('forum', $boardcat);
    $breadcrumbs->push(trans('app.edit_post'), action('BoardController@post_edit', [$post->thread_id, $post->id]));
});

//----------------- Developers ---------------------------------------------------------------------------------------//
// Home > Developers
Breadcrumbs::register('developers', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.developers'), url('developers'));
});

// Home > Developers > Developer
Breadcrumbs::register('developer', function ($breadcrumbs, $developer) {
    $breadcrumbs->parent('developers');
    $breadcrumbs->push($developer->name, action('DeveloperController@show', $developer->id));
});

//----------------- Pages --------------------------------------------------------------------------------------------//
// Home > Impressum
Breadcrumbs::register('impressum', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.imprint'), url('/impressum'));
});

//----------------- Auth --------------------------------------------------------------------------------------------//
// Home -> Login
Breadcrumbs::register('login', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.login'), action('Auth\LoginController@showLoginForm'));
});

//----------------- News ---------------------------------------------------------------------------------------------//
// Home -> News
Breadcrumbs::register('news', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.news'), action('NewsController@index'));
});

// Home -> News -> [News]
Breadcrumbs::register('news.show', function ($breadcrumbs, $news) {
    $breadcrumbs->parent('news');
    $breadcrumbs->push($news->title, action('NewsController@show', $news->id));
});

// Home -> News -> [News] -> Edit
Breadcrumbs::register('news.edit', function ($breadcrumbs, $news) {
    $breadcrumbs->parent('news.show', $news);
    $breadcrumbs->push(trans('app.edit'), action('NewsController@edit', $news->id));
});


//----------------- Awards -------------------------------------------------------------------------------------------//
// Home -> Awards
Breadcrumbs::register('awards', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.awards'), action('AwardController@index'));
});

// Home -> Awards -> [Award]
Breadcrumbs::register('awards.show', function ($breadcrumbs, $award_cat) {
    $breadcrumbs->parent('awards');
    $breadcrumbs->push($award_cat->awardpage->title . ': ' . $award_cat->title, action('AwardController@show', $award_cat->id));
});

//----------------- Messanger / PN -----------------------------------------------------------------------------------//
// Home -> Messages
Breadcrumbs::register('messages', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.messages'), action('MessagesController@index'));
});

// Home > Messages > Erstellen
Breadcrumbs::register('messages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push(trans('app.create_new_pm'), action('MessagesController@create'));
});

// Home > Messages > [Msg->Titel]
Breadcrumbs::register('messages.show', function ($breadcrumbs, $thread) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push($thread->subject, action('MessagesController@show', $thread->id));
});

//----------------- Suche --------------------------------------------------------------------------------------------//
// Home -> Suche
Breadcrumbs::register('search', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.search'), action('SearchController@index'));
});

//----------------- Maker --------------------------------------------------------------------------------------------//
// Home -> Maker
Breadcrumbs::register('maker', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.makers'), action('MakerController@index'));
});

// Home -> Maker -> [Maker]
Breadcrumbs::register('maker.show', function ($breadcrumbs, $maker) {
    $breadcrumbs->parent('maker');
    $breadcrumbs->push($maker->title, action('MakerController@show', $maker->id));
});

//----------------- Shoutbox -----------------------------------------------------------------------------------------//
// Home -> Shoutbox
Breadcrumbs::register('shoutbox', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.shoutbox'), action('ShoutboxController@index'));
});

//----------------- Tags ---------------------------------------------------------------------------------------------//
// Home -> Tags
Breadcrumbs::register('tags', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.tags'), action('TaggingController@index'));
});

// Home -> Tags -> [tag]
Breadcrumbs::register('tag', function ($breadcrumbs, $tag) {
    $breadcrumbs->parent('tags');
    $breadcrumbs->push($tag->title, action('TaggingController@showGames', $tag->id));
});

//----------------- CDC ----------------------------------------------------------------------------------------------//
// Home -> coup de coeur
Breadcrumbs::register('cdc.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.coupdecoeur'), action('CDCController@index'));
});

// Home -> coup de coeur -> add
Breadcrumbs::register('cdc.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cdc.index');
    $breadcrumbs->push(trans('app.add_coupdecoeur'), action('CDCController@create'));
});

//----------------- Gamefiles ----------------------------------------------------------------------------------------//
// Home -> spieledatei
Breadcrumbs::register('gamefiles.add', function ($breadcrumbs, $game) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.add_gamefiles'), action('GameFileController@create', $game->id));
});

//----------------- Player -------------------------------------------------------------------------------------------//
// Home -> spieledatei
Breadcrumbs::register('webplayer', function ($breadcrumbs, $game, $gamefileid) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.webplayer'), action('PlayerController@index', $game->id));
});


//----------------- Registrieren -------------------------------------------------------------------------------------//
// Home -> account erstellen
Breadcrumbs::register('register', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.register_account'), action('Auth\RegisterController@showRegistrationForm'));
});

//----------------- Savegame Manager ---------------------------------------------------------------------------------//
// Home -> Savegame Manager
Breadcrumbs::register('savegamemanager.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.savegame_manager'), action('SavegameManagerController@index'));
});
// Home -> Savegame Manager -> Game
// Home -> Maker -> [Maker]
Breadcrumbs::register('savegamemanager.show', function ($breadcrumbs, $gamefile) {
    $breadcrumbs->parent('savegamemanager.index');
    $breadcrumbs->push($gamefile->game->title, action('SavegameManagerController@show', $gamefile->id));
});