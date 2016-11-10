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

Route::get('/', 'IndexController@index');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//Route::get('/home', 'HomeController@index');

Route::resource('news', 'NewsController');
Route::resource('games', 'GameController');
Route::resource('resources', 'ResourcesController');

//Submit Routen
Route::get('submit', 'SubmitController@index');
Route::get('submit/game', 'SubmitController@game_index');
Route::get('submit/developer', 'SubmitController@developer_index');
Route::get('submit/resource', 'SubmitController@resource_index');
Route::get('submit/news', 'SubmitController@news_index');
//Logo Routen
Route::get('submit/logo', 'SubmitController@logo_index');
Route::get('submit/logo/{id}', 'SubmitController@logo_get');
Route::post('submit/logo', 'SubmitController@logo_add');

//Autocomplete Routen
Route::get('ac_developer', 'AutocompleteController@developer');

