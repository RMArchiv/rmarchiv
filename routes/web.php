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

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

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

//Autocomplete Routen
Route::get('ac_developer/{term}', 'AutocompleteController@developer');

//Routen für Messageboxen
Route::get('submit/logo/success', 'MsgBoxController@submit_logo')->name('submit.logo.success');
Route::get('comment/success/{type}/{id}', 'MsgBoxController@comment_add')->name('news.comment.add.success');
Route::get('games/success/{id}', 'MsgBoxController@game_add')->name('game.add.success');

