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

    $api->get('developer/{id}', 'App\Http\Controllers\api\v1\DeveloperController@show');


    $api->get('tako/filelist', 'App\Http\Controllers\Api\v1\TakoController@filelist');
    $api->get('tako/filelist2', 'App\Http\Controllers\Api\v1\TakoController@filelist2');
    $api->get('tako/makers', 'App\Http\Controllers\Api\v1\TakoController@getMakers');
    $api->get('tako/dev/{gameid}', 'App\Http\Controllers\Api\v1\TakoController@getdevelopers');

    //GameClient API
    $api->get('client/games/{datetime}', 'App\Http\Controllers\Api\Client\GamesController@index');

    $api->get('client/screenshots/{id}', 'App\Http\Controllers\Api\Client\ScreenshotsController@get_screens');

    $api->get('client/developers', 'App\Http\Controllers\Api\Client\DevelopersController@index');


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
});
