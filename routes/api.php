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

        $api->post('games/{id}/ratings', 'App\Http\Controllers\Api\v3\RatingsController@store');

        $api->get('gamefiles/{gamefileId}/savegames', 'App\Http\Controllers\Api\v3\SavegamesController@index');
        $api->put('gamefiles/{gamefileId}/savegames', 'App\Http\Controllers\Api\v3\SavegamesController@store');
        $api->put('gamefiles/{gamefileId}/savegames/{slotId}', 'App\Http\Controllers\Api\v3\SavegamesController@storeSlot');
    });
});
