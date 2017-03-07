<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
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
Route::get('user_settings/change/{setting}/{value}', 'UserSettingsController@change_setting');
Route::post('user_settings/rowsperpage', 'UserSettingsController@store_rowsPerPage');

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
Route::get('games/{id}/gamefiles/edit/{gamefileid}', 'GameFileController@edit')->name('gamefiles.edit');
Route::post('games/{id}/gamefiles/edit/{gamefileid}/update', 'GameFileController@update')->name('gamefiles.update');
Route::get('games/download/{id}', 'GameFileController@download')->name('gamefiles.download');
Route::get('games/{gameid}/screenshot/show/{screenid}/{full?}', 'ScreenshotController@show')->name('screenshot.show');
Route::get('games/{gameid}/screenshot/create/{screenid}', 'ScreenshotController@create')->name('screenshot.create');
Route::post('games/{gameid}/screenshot/upload/{screenid}', 'ScreenshotController@upload')->name('screenshot.upload');
Route::get('games/index/{orderby?}/{direction?}', 'GameController@index')->name('games.index.sorted');

Route::post('gameupload', '\Optimus\FineuploaderServer\Controller\LaravelController@upload');
Route::delete('gameupload/delete/{uuid}', '\Optimus\FineuploaderServer\Controller\LaravelController@delete');
Route::get('gameupload/session', '\Optimus\FineuploaderServer\Controller\LaravelController@session');

//History Routen
Route::get('history/game/{id}', 'HistoryController@index')->name('history.game.index');

//Routen für Maker Seiten
Route::get('makers/{orderby?}/{direction?}', 'MakerController@index')->name('maker.index.sorted');
Route::get('maker/{makerid}/{orderby?}/{direction?}', 'MakerController@show')->name('maker.show');

//Reporting Routen
//Route::get('reports', 'ReportController@index');

Route::get('reports/add/game/{gameid}', 'ReportController@create_game_report');
Route::post('reports/add/game/{gameid}', 'ReportController@store_game_report');
Route::get('reports', 'ReportController@index_user');
Route::get('reports/close/{id}', 'ReportController@close_ticket');
Route::get('reports/open/{id}', 'ReportController@open_ticket');
Route::get('reports/remark/{id}', 'ReportController@remark_ticket');

//Gamecredits routen
Route::post('games/{id}/credit', 'UserCreditsController@store')->name('gamecredits.store');
Route::get('games/{id}/credit/{credit_id}/delete', 'UserCreditsController@destroy')->name('gamecredits-delete');

//Suchrouten
Route::get('search', 'SearchController@index');
Route::post('search', 'SearchController@search');

//Entwickler Routen
Route::resource('developer', 'DeveloperController');
Route::get('developer/index/{orderby?}/{direction?}', 'DeveloperController@index')->name('developer.index.sorted');
Route::get('developer/{id}/{orderby?}/{direction?}', 'DeveloperController@show');

//CDC Routen
Route::resource('cdc', 'CDCController');

//Ressource Routen
Route::group(['prefix' => 'resources'], function () {
    Route::get('/', ['as' => 'resources', 'uses' => 'ResourceController@index']);
    Route::get('/gfx', ['as' => 'resources.gfx', 'uses' => 'ResourceController@index_gfx']);
    Route::get('/gfx/{cat}', ['as' => 'resources.gfx.cat', 'uses' => 'ResourceController@index_gfx_cat']);
    Route::get('/sfx', ['as' => 'resources.sfx', 'uses' => 'ResourceController@index_sfx']);
    Route::get('/sfx/{cat}', ['as' => 'resources.sfx.cat', 'uses' => 'ResourceController@index_sfx_cat']);
    Route::get('/scripts', ['as' => 'resources.scripts', 'uses' => 'ResourceController@index_scripts']);
    Route::get('/scripts/{cat}', ['as' => 'resources.scripts.cat', 'uses' => 'ResourceController@index_scripts_cat']);
    Route::get('/tools', ['as' => 'resources.tools', 'uses' => 'ResourceController@index_tools']);
    Route::get('/tools/{cat}', ['as' => 'resources.tools.cat', 'uses' => 'ResourceController@index_tools_cat']);

    Route::get('/{type}/{cat}/{id}', ['as' => 'resources.show', 'uses' => 'ResourceController@show']);

    Route::post('/create', ['as' => 'resources.create_steps', 'uses' => 'ResourceController@create_steps']);
    Route::get('/create', ['as' => 'resources.create', 'uses' => 'ResourceController@create']);
    Route::post('/create/store', ['as' => 'resources.store', 'uses' => 'ResourceController@store']);
});

Route::post('resources/upload', 'FineUploaderController@endpoint@upload')->name('resources.upload');

//User Routings
Route::get('users', 'UserController@index');
Route::get('users/activity', 'UserController@activity_index');
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
Route::get('board/thread/{threadid}/edit/{postid}', 'BoardController@post_edit')->name('board.post.edit');
Route::post('board/thread/{threadid}/edit/{postid}', 'BoardController@post_update')->name('board.post.update');
Route::get('board/thread/{threadid}', 'BoardController@show_thread')->name('board.thread.show');
Route::post('board/thread/{threadid}', 'BoardController@store_post')->name('board.post.store');
Route::get('board/thread/{id}/switchclosestate/{state}', 'BoardController@thread_close_switch')->name('board.thread.switch.close');

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
Route::get('lists/create', 'UserListController@create');
Route::post('lists/create', 'UserListController@store');
Route::get('lists/{userid}', 'UserListController@index');
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

//Routen für Fehlendes oder Statistiken
Route::get('missing/gamescreens', 'MissingController@index_gamescreens');
Route::get('missing/gamefiles', 'MissingController@index_gamefiles');
Route::get('missing/gamedesc', 'MissingController@index_gamedesc');
Route::get('missing/notags/{orderby?}/{direction?}', 'MissingController@index_notags');

//Sonstige Seiten
Route::get('/impressum', function () {
    return View::make('_pages.impressum');
});
Route::get('/gratz', function () {
    return View::make('_pages.gratz');
});

//Routen für Sitemap
Route::get('sitemap', 'SitemapController@index')->name('sitemap.index');
Route::get('sitemap/users', 'SitemapController@users')->name('sitemap.users');
Route::get('sitemap/games', 'SitemapController@games')->name('sitemap.games');
Route::get('sitemap/developer', 'SitemapController@developer')->name('sitemap.developer');
Route::get('sitemap/board', 'SitemapController@board')->name('sitemap.board');
Route::get('sitemap/news', 'SitemapController@news')->name('sitemap.news');

//Routen für Statistiken
Route::get('stats', 'StatsticController@show');

//Routen für Tags
Route::post('tags/create', 'TaggingController@store');
Route::get('tags/game/{tagid}', 'TaggingController@showGames');
Route::get('tags', 'TaggingController@index');
Route::get('tags/{orderby?}/{direction?}', 'TaggingController@index')->name('tags.index.sorted');
Route::get('tags/delete/game/{gameid}/{tagid}', 'TaggingController@delete_gametag');

//Routen für Events
Route::group(['prefix' => 'events'], function () {
    Route::get('/', ['as' => 'events', 'uses' => 'EventController@index']);
    Route::get('create', ['as' => 'events.create', 'uses' => 'EventController@create']);
    Route::post('/', ['as' => 'events.store', 'uses' => 'EventController@store']);
    Route::get('{id}', ['as' => 'events.show', 'uses' => 'EventController@show']);
    Route::get('{id}/edit', ['as' => 'events.edit', 'uses' => 'EventController@edit']);
    Route::put('{id}', ['as' => 'events.update', 'uses' => 'EventController@update']);
    Route::get('register/{eventid}', ['as' => 'events.register', 'uses' => 'EventController@register']);
    Route::post('register/{eventid}', ['as' => 'events.register.store', 'uses' => 'EventController@register_store']);

    Route::group(['prefix' => 'meetings'], function () {
        Route::get('/', ['as' => 'meetings', 'uses' => 'EventController@meeting_index']);
        Route::get('create', ['as' => 'meetings.create', 'uses' => 'EventController@meeting_create']);
        Route::post('/', ['as' => 'meetings.store', 'uses' => 'EventController@meeting_store']);
        Route::get('{id}', ['as' => 'meetings.show', 'uses' => 'EventController@meeting_show']);
        Route::get('{id}/edit', ['as' => 'meetings.edit', 'uses' => 'EventController@meeting_edit']);
        Route::put('{id}', ['as' => 'meetings.update', 'uses' => 'EventController@meeting_update']);
    });

    Route::group(['prefix' => 'pictures'], function () {
        Route::get('/', ['as' => 'pictures', 'uses' => 'EventController@picture_index']);
        Route::get('create', ['as' => 'pictures.create', 'uses' => 'EventController@picture_create']);
        Route::post('/', ['as' => 'pictures.store', 'uses' => 'EventController@picture_store']);
        Route::get('{id}', ['as' => 'pictures.show', 'uses' => 'EventController@picture_show']);
        Route::get('{id}/edit', ['as' => 'pictures.edit', 'uses' => 'EventController@picture_edit']);
        Route::put('{id}', ['as' => 'pictures.update', 'uses' => 'EventController@picture_update']);
    });
});

//attachment Routen
Route::post('attachment/upload', 'SubmitController@attachment_submit');

//Spezialrouten
Route::post('tako/downlbla', 'GameFileController@download_wo_count');
Route::get('test', 'TestController@index');
Route::post('tlg/webhook', 'TestController@webhook');

//Routen für API
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('games', 'App\Http\Controllers\Api\v1\GameController@index');
    $api->get('games/{id}', 'App\Http\Controllers\Api\v1\GameController@show');
    $api->get('games_app', 'App\Http\Controllers\Api\v1\GameController@show_app');
    $api->get('tako/filelist', 'App\Http\Controllers\Api\v1\TakoController@filelist');
});

Route::get('logo/{filename}', function ($filename) {
    $filename =  'logos/'.$filename;
    dd($filename);
    $path = Storage::get($filename);

    if (! File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
});
