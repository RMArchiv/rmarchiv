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

//Benutzer und Authentifizierung
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::resource('user_settings', 'UserSettingsController');

//Route::get('/home', 'HomeController@index');

//News Routen
Route::resource('news', 'NewsController');
Route::get('news/{id}/approve/{approve}', 'NewsController@approve');

//Games Routen
Route::resource('games', 'GameController');
Route::post('games/{id}/developer', 'GameController@store_developer')->name('games.developer.store');
Route::post('games/{id}/developer/delete', 'GameController@destroy_developer')->name('games.developer.delete');
Route::get('games/{id}/gamefiles', 'GameFileController@create')->name('gamefiles.index');
Route::post('games/{id}/gamefiles', 'GameFileController@store')->name('gamefiles.store');
Route::post('games/{id}/gamefiles/upload', 'FineUploaderController@endpoint@upload')->name('gamefiles.upload');
Route::post('games/{id}/gamefiles/delete', 'GameFileController@destroy')->name('gamefiles.delete');
Route::get('games/download/{id}', 'GameFileController@download')->name('gamefiles.download');
Route::get('games/{gameid}/screenshot/{screenid}', 'ScreenshotController@show')->name('screenshot.show');
Route::get('games/{gameid}/screenshot/create/{screenid}', 'ScreenshotController@create')->name('screenshot.create');
Route::post('games/{gameid}/screenshot/upload/{screenid}', 'ScreenshotController@upload')->name('screenshot.upload');

//Suchrouten
Route::get('search', 'SearchController@index');
Route::get('search/{term}', 'SearchController@search');

//Entwickler Routen
Route::resource('developer', 'DeveloperController');

//CDC Routen
Route::resource('cdc', 'CDCController');

//Ressource Routen
Route::resource('resources', 'ResourceController');

//User Routings
Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@get');

//Comment routings
Route::post('comment', 'CommentController@add');

//Logo Voting
Route::get('logo/vote', 'LogoController@vote_get')->name('logo.vote');
Route::post('logo/vote/{id}', 'LogoController@vote_add');

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


//Autocomplete Routen
Route::get('ac_developer/{term}', 'AutocompleteController@developer');
Route::get('ac_games/{term}', 'AutocompleteController@game');

//Routen für Messageboxen
Route::get('submit/logo/success', 'MsgBoxController@submit_logo')->name('submit.logo.success');
Route::get('comment/success/{type}/{id}', 'MsgBoxController@comment_add')->name('news.comment.add.success');
Route::get('games/success/{id}', 'MsgBoxController@game_add')->name('game.add.success');
Route::get('screenshot/upload/success/{gameid}', 'MsgBoxController@screenshot_add')->name('screenshot.upload.success');
Route::get('cdc/success/{gameid}', 'MsgBoxController@cdc_add');

