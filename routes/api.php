<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Routen für API
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('games', 'App\Http\Controllers\Api\v1\GameController@index');
    $api->get('games/{id}', 'App\Http\Controllers\Api\v1\GameController@show');
    $api->get('games_app', 'App\Http\Controllers\Api\v1\GameController@show_app');

    $api->get('developer/{id}', 'App\Http\Controllers\Api\v1\DeveloperController@show');


    $api->get('tako/filelist', 'App\Http\Controllers\Api\v1\TakoController@filelist');
    $api->get('tako/filelist2', 'App\Http\Controllers\Api\v1\TakoController@filelist2');
    $api->get('tako/makers', 'App\Http\Controllers\Api\v1\TakoController@getMakers');
    $api->get('tako/dev/{gameid}', 'App\Http\Controllers\Api\v1\TakoController@getdevelopers');

    //GameClient API
    $api->get('client/games/{datetime}', 'App\Http\Controllers\Api\Client\GamesController@index');

    $api->get('client/screenshots/{id}', 'App\Http\Controllers\Api\Client\ScreenshotsController@get_screens');

    $api->get('client/developers', 'App\Http\Controllers\Api\Client\DeveloperController@index');


    //EasyRPG Hash API
    $api->get('easyrpg', 'App\Http\Controllers\Api\v1\EasyRPGController@index');
    $api->get('easyrpg/{ldbhash}', 'App\Http\Controllers\Api\v1\EasyRPGController@show');

    $api->group(['prefix' => 'v2'], function ($api) { // Use this route group for v2

        $api->get('test', 'App\Http\Controllers\Api\v2\TestController@show');

        $api->group(['prefix' => 'auth'], function (\Dingo\Api\Routing\Router $api) {
            $api->post('login', 'App\Http\Controllers\Api\v2\AuthenticationController@login');
        });

        $api->group(['prefix' => 'games'], function (\Dingo\Api\Routing\Router $api) {
            $api->get('/', 'App\Http\Controllers\Api\v2\GamesController@index');
        });
    });

    $api->group(['prefix' => 'v3'], function (\Dingo\Api\Routing\Router $api) {
        $api->group(['prefix' => 'auth'], function (\Dingo\Api\Routing\Router $api) {
            $api->post('login', 'App\Http\Controllers\Api\v3\AuthController@login');
        });

        $api->get('games', 'App\Http\Controllers\Api\v3\GamesController@index');
        $api->get('games/search', 'App\Http\Controllers\Api\v3\GamesController@search');
        $api->get('games/{id}', 'App\Http\Controllers\Api\v3\GamesController@show');
        $api->get('games/{id}/screenshots', 'App\Http\Controllers\Api\v3\ScreenshotsController@index');
        $api->get('games/{id}/gamefiles', 'App\Http\Controllers\Api\v3\GamefilesController@index');
        $api->get('games/{id}/awards', 'App\Http\Controllers\Api\v3\AwardsController@gameAwards');
        $api->get('games/{id}/cdcs', 'App\Http\Controllers\Api\v3\AwardsController@gameCdcs');

        $api->post('games/{id}/ratings', 'App\Http\Controllers\Api\v3\RatingsController@store');

        $api->get('gamefiles/{gamefileId}/savegames', 'App\Http\Controllers\Api\v3\SavegamesController@index');
        $api->put('gamefiles/{gamefileId}/savegames', 'App\Http\Controllers\Api\v3\SavegamesController@store');
        $api->put('gamefiles/{gamefileId}/savegames/{slotId}', 'App\Http\Controllers\Api\v3\SavegamesController@storeSlot');

        $api->get('users', 'App\Http\Controllers\Api\v3\UsersController@index');
        $api->get('users/me', 'App\Http\Controllers\Api\v3\UsersController@me');
        $api->get('users/online', 'App\Http\Controllers\Api\v3\UsersController@online');
        $api->get('users/{id}', 'App\Http\Controllers\Api\v3\UsersController@show');
        $api->get('users/{id}/lists', 'App\Http\Controllers\Api\v3\UserListsController@index');
        $api->get('lists/{id}', 'App\Http\Controllers\Api\v3\UserListsController@show');
        $api->post('users/me/lists', 'App\Http\Controllers\Api\v3\UserListsController@store');
        $api->put('users/me/lists/{id}', 'App\Http\Controllers\Api\v3\UserListsController@update');
        $api->delete('users/me/lists/{id}', 'App\Http\Controllers\Api\v3\UserListsController@destroy');
        $api->post('users/me/lists/{id}/items', 'App\Http\Controllers\Api\v3\UserListsController@addItem');
        $api->delete('users/me/lists/{id}/items/{itemId}', 'App\Http\Controllers\Api\v3\UserListsController@removeItem');
        $api->get('users/me/downloads', 'App\Http\Controllers\Api\v3\UsersController@downloads');

        $api->get('comments', 'App\Http\Controllers\Api\v3\CommentsController@index');
        $api->post('comments', 'App\Http\Controllers\Api\v3\CommentsController@store');

        $api->get('forum/categories', 'App\Http\Controllers\Api\v3\ForumController@categories');
        $api->get('forum/threads', 'App\Http\Controllers\Api\v3\ForumController@threads');
        $api->get('forum/threads/{id}', 'App\Http\Controllers\Api\v3\ForumController@thread');
        $api->get('forum/threads/{id}/posts', 'App\Http\Controllers\Api\v3\ForumController@posts');
        $api->post('forum/threads', 'App\Http\Controllers\Api\v3\ForumController@storeThread');
        $api->post('forum/threads/{id}/posts', 'App\Http\Controllers\Api\v3\ForumController@storePost');

        $api->get('news', 'App\Http\Controllers\Api\v3\NewsController@index');
        $api->get('news/{id}', 'App\Http\Controllers\Api\v3\NewsController@show');

        $api->get('resources', 'App\Http\Controllers\Api\v3\ResourcesController@index');
        $api->get('resources/{id}', 'App\Http\Controllers\Api\v3\ResourcesController@show');

        $api->get('developers', 'App\Http\Controllers\Api\v3\DevelopersController@index');
        $api->get('developers/{id}', 'App\Http\Controllers\Api\v3\DevelopersController@show');

        $api->get('meta/tags', 'App\Http\Controllers\Api\v3\MetaController@tags');
        $api->get('meta/makers', 'App\Http\Controllers\Api\v3\MetaController@makers');
        $api->get('meta/languages', 'App\Http\Controllers\Api\v3\MetaController@languages');
        $api->get('meta/licenses', 'App\Http\Controllers\Api\v3\MetaController@licenses');

        $api->get('awards/pages', 'App\Http\Controllers\Api\v3\AwardsController@pages');
        $api->get('awards/cats', 'App\Http\Controllers\Api\v3\AwardsController@cats');
        $api->get('awards/subcats', 'App\Http\Controllers\Api\v3\AwardsController@subcats');

        $api->get('events', 'App\Http\Controllers\Api\v3\EventsController@index');
        $api->get('events/{id}', 'App\Http\Controllers\Api\v3\EventsController@show');

        $api->get('messages/threads', 'App\Http\Controllers\Api\v3\MessagesController@threads');
        $api->get('messages/threads/{id}', 'App\Http\Controllers\Api\v3\MessagesController@thread');
        $api->get('messages/threads/{id}/messages', 'App\Http\Controllers\Api\v3\MessagesController@messages');

        $api->get('reports', 'App\Http\Controllers\Api\v3\ReportsController@index');
        $api->post('reports', 'App\Http\Controllers\Api\v3\ReportsController@store');

        $api->get('logos', 'App\Http\Controllers\Api\v3\LogosController@index');
        $api->get('logos/{id}', 'App\Http\Controllers\Api\v3\LogosController@show');
    });
});
