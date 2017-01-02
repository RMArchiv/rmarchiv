<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('home');

//Administration
Route::get('users/admin/{userid}', 'UserController@admin')->name('user.admin');
Route::post('users/admin/{userid}', 'UserController@admin_store');
Route::get('users/perm/role', 'UserPermissionController@createRole');
Route::post('users/perm/role', 'UserPermissionController@storeRole')->name('user.perm.role.store');
Route::get('users/perm/permissions', 'UserPermissionController@createPermission');
Route::post('users/perm/permission', 'UserPermissionController@storePermission')->name('user.perm.perm.store');
Route::get('users/perm/role/{id}', 'UserPermissionController@showRole');
Route::get('users/perm/permissions/{id}', 'UserPermissionController@showPermission');
Route::post('users/perm/role/{roleid}', 'UserPermissionController@addPermToRole')->name('user.perm.permtorole');
Route::get('users/perm/role/{roleid}/remove/{permid}', 'UserPermissionController@removePermFromRole')->name('user.perm.removefromrole');

//Benutzer und Authentifizierung
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Benutzereinstellungen
Route::get('user_settings', 'UserSettingsController@index');
Route::post('user_settings/password', 'UserSettingsController@store_password');

//News Routen
Route::resource('news', 'NewsController');
Route::get('news/{id}/approve/{approve}', 'NewsController@approve');

//Games Routen
Route::resource('games', 'GameController');
Route::post('games/{id}/developer', 'GameController@store_developer')->name('games.developer.store');
Route::post('games/{id}/developer/delete', 'GameController@destroy_developer')->name('games.developer.delete');
//Gamefiles routen
Route::get('games/{id}/gamefiles', 'GameFileController@create')->name('gamefiles.index');
Route::post('games/{id}/gamefiles', 'GameFileController@store')->name('gamefiles.store');
Route::post('games/{id}/gamefiles/upload', 'FineUploaderController@endpoint@upload')->name('gamefiles.upload');
Route::get('games/{id}/gamefiles/delete/{fileid}', 'GameFileController@destroy')->name('gamefiles.delete');
Route::get('games/download/{id}', 'GameFileController@download')->name('gamefiles.download');
Route::get('games/{gameid}/screenshot/{screenid}', 'ScreenshotController@show')->name('screenshot.show');
Route::get('games/{gameid}/screenshot/create/{screenid}', 'ScreenshotController@create')->name('screenshot.create');
Route::post('games/{gameid}/screenshot/upload/{screenid}', 'ScreenshotController@upload')->name('screenshot.upload');
//Gamecredits routen
Route::post('games/{id}/credit', 'UserCreditsController@store')->name('gamecredits.store');
Route::get('games/{id}/credit/{credit_id}/delete', 'UserCreditsController@destroy')->name('gamecredits-delete');

//Suchrouten
Route::get('search', 'SearchController@index');
Route::get('search/{term}', 'SearchController@search');

//Entwickler Routen
Route::resource('developer', 'DeveloperController');

//CDC Routen
Route::resource('cdc', 'CDCController');

//Ressource Routen

Route::group(['prefix' => 'resources'], function () {
    Route::get('/', ['as' => 'resources', 'uses' => 'ResourceController@index']);
    Route::get('/gfx', ['as' => 'resources.gfx', 'uses' => 'ResourceController@index']);
    Route::get('/sfx', ['as' => 'resources.sfx', 'uses' => 'ResourceController@index']);
    Route::get('/scripts', ['as' => 'resources.scripts', 'uses' => 'ResourceController@index']);
    Route::get('/tools', ['as' => 'resources.tools', 'uses' => 'ResourceController@index']);
});

//User Routings
Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show')->name('users.show');

//PN Routen
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

//Comment routings
Route::post('comment', 'CommentController@add');

//Logo Voting
Route::get('logo/vote', 'LogoController@vote_get')->name('logo.vote');
Route::post('logo/vote/{userid}', 'LogoController@vote_add');

//Submit Routen
Route::get('submit', 'SubmitController@index');

//Logo Routen
Route::get('submit/logo', 'SubmitController@logo_index');
Route::post('submit/logo', 'SubmitController@logo_add');

//Shoutbox Routen
Route::post('shoutbox', 'ShoutboxController@store');
Route::get('shoutbox', 'ShoutboxController@index');

//Routen für Forum/Board
Route::get('board', 'BoardController@index')->name('board.show');
Route::get('board/create', 'BoardController@create_cat')->name('board.cat.create');
Route::post('board/create', 'BoardController@store_cat')->name('board.cat.store');
Route::get('board/cat/{catid}', 'BoardController@show_cat')->name('board.cat.show');
Route::get('board/cat/{catid}/{direction}', 'BoardController@order_cat')->name('board.cat.order');
Route::get('board/cat/{catid}/thread/create', 'BoardController@create_thread')->name('board.thread.create');
Route::post('board/thread/create', 'BoardController@store_thread')->name('board.thread.store');
Route::get('board/thread/{threadid}', 'BoardController@show_thread')->name('board.thread.show');
Route::post('board/thread/{threadid}', 'BoardController@store_post')->name('board.post.store');

//Routen für FAQ
Route::get('faq', 'FaqController@index');
Route::get('faq/create', 'FaqController@create');
Route::post('faq', 'FaqController@store');

//Routen für Awards
Route::get('awards', 'AwardController@index')->name('awards.index');
Route::get('awards/create', 'AwardController@create')->name('awards.create');
Route::get('awards/gameadd/{subcatid}', 'AwardController@gameadd')->name('awards.gameadd');
Route::get('awards/{awardid}', 'AwardController@show')->name('awards.show');
Route::post('awards/store/page', 'AwardController@store_page');
Route::post('awards/store/cat', 'AwardController@store_cat');
Route::post('awards/store/subcat', 'AwardController@store_subcat');
Route::post('awards/gameadd/', 'AwardController@gameadd_store');

//Routen für Userlisten
Route::get('lists/{userid}', 'UserListController@index');
Route::get('lists/create', 'UserListController@create');
Route::post('lists/create', 'UserListController@store');
Route::get('lists/{listid}/add_game/{gameid}', 'UserListController@add_game')->name('lists.add_game');
Route::get('lists/{userid}/show/{listid}', 'UserListController@show');
Route::get('lists/{listid}/delete/game/{itemid}', 'UserListController@delete_game')->name('lists.delete_game');
Route::get('lists/delete/{listid}', 'UserListController@delete');

//Autocomplete Routen
Route::get('ac_developer/{term}', 'AutocompleteController@developer');
Route::get('ac_games/{term}', 'AutocompleteController@game');
Route::get('ac_faqcat/{term}', 'AutocompleteController@faqcat');
Route::get('ac_award_page/{term}', 'AutocompleteController@awardpage');
Route::get('ac_award_cat/{term}', 'AutocompleteController@awardcat');
Route::get('ac_award_subcat/{term}', 'AutocompleteController@awardsubcat');
Route::get('ac_user/{term}', 'AutocompleteController@user');

//Routen für Messageboxen
Route::get('submit/logo/success', 'MsgBoxController@submit_logo')->name('submit.logo.success');
Route::get('comment/success/{type}/{id}', 'MsgBoxController@comment_add')->name('news.comment.add.success');
Route::get('games/success/{id}', 'MsgBoxController@game_add')->name('game.add.success');
Route::get('screenshot/upload/success/{gameid}', 'MsgBoxController@screenshot_add')->name('screenshot.upload.success');
Route::get('cdc/success/{gameid}', 'MsgBoxController@cdc_add');

//Sonstige Seiten
Route::get("/impressum", function(){
    return View::make("_pages.impressum");
});

//Routen für Sitemap
Route::get('sitemap', 'SitemapController@index')->name('sitemap.index');
Route::get('sitemap/users', 'SitemapController@users')->name('sitemap.users');
Route::get('sitemap/games', 'SitemapController@games')->name('sitemap.games');
Route::get('sitemap/developer', 'SitemapController@developer')->name('sitemap.developer');
Route::get('sitemap/board', 'SitemapController@board')->name('sitemap.board');
Route::get('sitemap/news', 'SitemapController@news')->name('sitemap.news');