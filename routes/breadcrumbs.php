<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->push(trans('app.home'), action('IndexController@index'));
});

//----------------- Games --------------------------------------------------------------------------------------------//
// Home > Games
Breadcrumbs::for('games', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.games'), url('games'));
});

// Home > Games > [game]
Breadcrumbs::for('game', function (BreadcrumbTrail $breadcrumbs, $game) {
    $breadcrumbs->parent('games');
    if ($game->subtitle) {
        $breadcrumbs->push($game->title.' - '.$game->subtitle, action('GameController@show', $game->id));
    } else {
        $breadcrumbs->push($game->title, action('GameController@show', $game->id));
    }
});

// Home > Games > erstellen
Breadcrumbs::for('game-add', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('games');
    $breadcrumbs->push(trans('app.add_game'), action('GameController@create'));
});

// Home > Games > [game] > edit
Breadcrumbs::for('game-edit', function (BreadcrumbTrail $breadcrumbs, $game) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.edit_game'), action('GameController@edit', $game->id));
});

// Home > Games > [game] > report
Breadcrumbs::for('game-report', function (BreadcrumbTrail $breadcrumbs, $game) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.report_game'), action('ReportController@create_game_report', $game->id));
});

// Home > Games > [game] > Add Screenshot
Breadcrumbs::for('game-screenshot', function (BreadcrumbTrail $breadcrumbs, $game, $screenid) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.screenshot'), action('ScreenshotController@create', [$game->id, $screenid]));
});

Breadcrumbs::for('game.changelog', function (BreadcrumbTrail $breadcrumbs, $game) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.changelog'), action('HistoryController@index', $game->id));
});

//----------------- FAQ ----------------------------------------------------------------------------------------------//
// Home > FAQ
Breadcrumbs::for('faq', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.faq'), action('FaqController@index'));
});
// FAQ > Add
Breadcrumbs::for('faq-add', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('faq');
    $breadcrumbs->push(trans('app.add_faq'), action('FaqController@create'));
});

//----------------- Users --------------------------------------------------------------------------------------------//
// Home > Users
Breadcrumbs::for('users', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.users'), action('UserController@index'));
});

// Home > Users > [username]
Breadcrumbs::for('user', function (BreadcrumbTrail $breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->name, action('UserController@show', $user->id));
});

// Home > Users > Online
Breadcrumbs::for('online', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('app.users_online'), action('UserController@users_online'));
});

// Home > Users > Online
Breadcrumbs::for('user.activities', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('app.user_activities'), action('UserController@activity_index'));
});

//----------------- Board --------------------------------------------------------------------------------------------//
// Home > Board
Breadcrumbs::for('forums', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.board'), action('BoardController@index'));
});

// Home > Board > [Forum]
Breadcrumbs::for('forum', function (BreadcrumbTrail $breadcrumbs, $boardcat) {
    $breadcrumbs->parent('forums');
    $breadcrumbs->push($boardcat->title, action('BoardController@show_cat', $boardcat->id));
});

// Home > Board > [Forum] -> [Thread]
Breadcrumbs::for('thread', function (BreadcrumbTrail $breadcrumbs, $boardcat, $thread) {
    $breadcrumbs->parent('forum', $boardcat);
    $breadcrumbs->push($thread->title, action('BoardController@show_thread', $thread->id));
});

// Home > Board > [Forum] -> [Thread] -> edit
Breadcrumbs::for('post.edit', function (BreadcrumbTrail $breadcrumbs, $boardcat, $post) {
    $breadcrumbs->parent('forum', $boardcat);
    $breadcrumbs->push(trans('app.edit_post'), action('BoardController@post_edit', [$post->thread_id, $post->id]));
});

// Home > Board > [Forum] -> [Thread] -> Add/Edit Vote
Breadcrumbs::for('board.vote', function (BreadcrumbTrail $breadcrumbs, $boardcat, $thread) {
    $breadcrumbs->parent('forum', $boardcat);
    $breadcrumbs->push(trans('app.create_vote'), action('BoardController@create_vote', [$thread->id]));
});

//----------------- Developers ---------------------------------------------------------------------------------------//
// Home > Developers
Breadcrumbs::for('developers', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.developers'), url('developer'));
});

// Home > Developers > Developer
Breadcrumbs::for('developer', function (BreadcrumbTrail $breadcrumbs, $developer) {
    $breadcrumbs->parent('developers');
    $breadcrumbs->push($developer->name, action('DeveloperController@show', $developer->id));
});

//----------------- Pages --------------------------------------------------------------------------------------------//
// Home > Impressum
Breadcrumbs::for('impressum', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.imprint'), url('/impressum'));
});

//----------------- Auth --------------------------------------------------------------------------------------------//
// Home -> Login
Breadcrumbs::for('login', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.login'), action('Auth\LoginController@showLoginForm'));
});

//----------------- News ---------------------------------------------------------------------------------------------//
// Home -> News
Breadcrumbs::for('news', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.news'), action('NewsController@index'));
});

// Home -> Create
Breadcrumbs::for('news.create', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.create_news'), action('NewsController@create'));
});

// Home -> News -> [News]
Breadcrumbs::for('news.show', function (BreadcrumbTrail $breadcrumbs, $news) {
    $breadcrumbs->parent('news');
    $breadcrumbs->push($news->title, action('NewsController@show', $news->id));
});

// Home -> News -> [News] -> Edit
Breadcrumbs::for('news.edit', function (BreadcrumbTrail $breadcrumbs, $news) {
    $breadcrumbs->parent('news.show', $news);
    $breadcrumbs->push(trans('app.edit'), action('NewsController@edit', $news->id));
});

//----------------- Awards -------------------------------------------------------------------------------------------//
// Home -> Awards
Breadcrumbs::for('awards', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.awards'), action('AwardController@index'));
});

// Home -> Awards -> [Award]
Breadcrumbs::for('awards.show', function (BreadcrumbTrail $breadcrumbs, $award_cat) {
    $breadcrumbs->parent('awards');
    $breadcrumbs->push($award_cat->awardpage->title.': '.$award_cat->title, action('AwardController@show', $award_cat->id));
});

// Home -> Awards -> [Award] -> Add Game
Breadcrumbs::for('awards.gameadd', function (BreadcrumbTrail $breadcrumbs, $subcatid) {
    $award_subcat = \App\Models\AwardSubcat::whereId($subcatid)->first();
    $award_cat = \App\Models\AwardCat::whereId($award_subcat->cat_id)->first();
    $breadcrumbs->parent('awards');
    $breadcrumbs->push(trans('app.add_game_to_award').': '.$award_cat->awardpage->title.': '.$award_cat->title.' - '.$award_subcat->title, action('AwardController@show', $award_cat->id));
});

// Home -> Awards -> Add Award Cats
Breadcrumbs::for('awards.catadd', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Awards hinzufügen', action('AwardController@index'));
});

//----------------- Messanger / PN -----------------------------------------------------------------------------------//
// Home -> Messages
Breadcrumbs::for('messages', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.messages'), action('MessagesController@index'));
});

// Home > Messages > Erstellen
Breadcrumbs::for('messages.create', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push(trans('app.create_new_pm'), action('MessagesController@create'));
});

// Home > Messages > [Msg->Titel]
Breadcrumbs::for('messages.show', function (BreadcrumbTrail $breadcrumbs, $thread) {
    $breadcrumbs->parent('messages');
    $breadcrumbs->push($thread->subject, action('MessagesController@show', $thread->id));
});

//----------------- Suche --------------------------------------------------------------------------------------------//
// Home -> Suche
Breadcrumbs::for('search', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.search'), action('SearchController@index'));
});

//----------------- Maker --------------------------------------------------------------------------------------------//
// Home -> Maker
Breadcrumbs::for('maker', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.makers'), action('MakerController@index'));
});

// Home -> Maker -> [Maker]
Breadcrumbs::for('maker.show', function (BreadcrumbTrail $breadcrumbs, $maker) {
    $breadcrumbs->parent('maker');
    $breadcrumbs->push($maker->title, action('MakerController@show', $maker->id));
});

//----------------- Shoutbox -----------------------------------------------------------------------------------------//
// Home -> Shoutbox
Breadcrumbs::for('shoutbox', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.shoutbox'), action('ShoutboxController@index'));
});

//----------------- Tags ---------------------------------------------------------------------------------------------//
// Home -> Tags
Breadcrumbs::for('tags', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.tags'), action('TaggingController@index'));
});

// Home -> Tags -> [tag]
Breadcrumbs::for('tag', function (BreadcrumbTrail $breadcrumbs, $tag) {
    $breadcrumbs->parent('tags');
    $breadcrumbs->push($tag->title, action('TaggingController@showGames', $tag->id));
});

//----------------- CDC ----------------------------------------------------------------------------------------------//
// Home -> coup de coeur
Breadcrumbs::for('cdc.index', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.coupdecoeur'), action('CDCController@index'));
});

// Home -> coup de coeur -> add
Breadcrumbs::for('cdc.create', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('cdc.index');
    $breadcrumbs->push(trans('app.add_coupdecoeur'), action('CDCController@create'));
});

//----------------- Gamefiles ----------------------------------------------------------------------------------------//
// Home -> spieledatei
Breadcrumbs::for('gamefiles.add', function (BreadcrumbTrail $breadcrumbs, $game) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.add_gamefiles'), action('GameFileController@create', $game->id));
});

// Home -> Games -> [Gametitle] -> [Gamefileversion] -> Edit
Breadcrumbs::for('gamefiles.edit', function (BreadcrumbTrail $breadcrumbs, $gamefile) {
    $breadcrumbs->parent('game', $gamefile->game);
    $breadcrumbs->push(trans('app.edit_gamefile').' - '.$gamefile->release_version, action('GameFileController@create', $gamefile->game->id));
});

//----------------- Player -------------------------------------------------------------------------------------------//
// Home -> spieledatei
Breadcrumbs::for('webplayer', function (BreadcrumbTrail $breadcrumbs, $game, $gamefileid) {
    $breadcrumbs->parent('game', $game);
    $breadcrumbs->push(trans('app.webplayer'), action('Player2kController@index', $game->id));
});

//----------------- Registrieren -------------------------------------------------------------------------------------//
// Home -> account erstellen
Breadcrumbs::for('register', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.register_account'), action('Auth\RegisterController@showRegistrationForm'));
});

//----------------- Savegame Manager ---------------------------------------------------------------------------------//
// Home -> Savegame Manager
Breadcrumbs::for('savegamemanager.index', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.savegame_manager'), action('SavegameManagerController@index'));
});
// Home -> Savegame Manager -> Game
// Home -> Maker -> [Maker]
Breadcrumbs::for('savegamemanager.show', function (BreadcrumbTrail $breadcrumbs, $gamefile) {
    $breadcrumbs->parent('savegamemanager.index');
    $breadcrumbs->push($gamefile->game->title, action('SavegameManagerController@show', $gamefile->id));
});

//----------------- Page Statistics ---------------------------------------------------------------------------------//
// Home -> Statistics
Breadcrumbs::for('statistics', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.statistics'), action('StatsticController@show'));
});

//----------------- Page Statistics ---------------------------------------------------------------------------------//
// Home -> Missing Titlescreens
Breadcrumbs::for('missing.titles', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.missing_screenshots'), action('MissingController@index_gamescreens'));
});

Breadcrumbs::for('missing.gamefiles', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.missing_gamefiles'), action('MissingController@index_gamefiles'));
});
Breadcrumbs::for('missing.gamedesc', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.missing_gamedescriptions'), action('MissingController@index_gamedesc'));
});
Breadcrumbs::for('missing.tags', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.games_without_tags'), action('MissingController@index_notags'));
});

//----------------- Usersettings -------------------------------------------------------------------------------------//
// Home -> Usersettings
Breadcrumbs::for('user.settings', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.user_settings'), action('UserSettingsController@index'));
});

//----------------- Userlists ----------------------------------------------------------------------------------------//

//Home -> User -> [User] -> Userlists
// Home -> Userlist
Breadcrumbs::for('userlist.index', function (BreadcrumbTrail $breadcrumbs, $user) {
    $breadcrumbs->parent('user', $user);
    $breadcrumbs->push(trans('app.userlists'), action('UserListController@index', [$user->id]));
});

// Home -> Userlist
Breadcrumbs::for('userlist.show', function (BreadcrumbTrail $breadcrumbs, $user, $list) {
    $breadcrumbs->parent('userlist.index', $user);
    $breadcrumbs->push(trans('app.userlist').': '.$list->title, action('UserListController@show', [$user->id, $list->id]));
});

Breadcrumbs::for('userlist.create', function (BreadcrumbTrail $breadcrumbs, $user) {
    $breadcrumbs->parent('userlist.index', $user);
    $breadcrumbs->push(trans('app.create_userlist'), action('UserListController@create'));
});

//----------------- Logo ---------------------------------------------------------------------------------------------//
// Home -> Logo Rating
Breadcrumbs::for('logorating', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.rate_logos'), action('LogoController@vote_get'));
});

Breadcrumbs::for('logoadd', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.submit_logo'), action('SubmitController@logo_index'));
});

//----------------- Ressources --------------------------------------------------------------------------------------------//
// Home > Ressources
Breadcrumbs::for('ressources', function (BreadcrumbTrail $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.resources_overview'), action('ResourceController@index'));
});

// Home > Games > [game]
Breadcrumbs::for('ressource', function (BreadcrumbTrail $breadcrumbs, $ressource) {
    $breadcrumbs->parent('ressources');
    $breadcrumbs->push($ressource->title, action('GameController@show', $ressource->id));
});