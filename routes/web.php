<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

Route::get('/', 'IndexController@index')->name('home');

//Administration
Route::group(['middelware' => ['permission:admin-user']], function () {
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
    Route::get('banuser/{userid}', 'UserBanController@show');
    Route::post('banuser/{userid}/ban', 'UserBanController@ban');
    Route::post('banuser/{userid}/unban', 'UserBanController@unban');
});

//Benutzer und Authentifizierung
Route::auth();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//Benutzereinstellungen
Route::get('user_settings', 'UserSettingsController@index')->middleware('auth');
Route::post('user_settings/password', 'UserSettingsController@store_password')->middleware('auth');
Route::get('user_settings/change/{setting}/{value}', 'UserSettingsController@change_setting')->middleware('auth');
Route::post('user_settings/rowsperpage', 'UserSettingsController@store_rowsPerPage')->middleware('auth');
Route::post('user_settings/change_username', 'UserSettingsController@change_username')->middleware('auth');
Route::post('user_settings/change_language', 'UserSettingsController@change_language')->middleware('auth');
Route::post('user_Settings/change_download_template', 'UserSettingsController@change_download_template')->middleware('auth');

//News Routen
Route::resource('news', 'NewsController');
Route::group(['middelware' => ['permission:approve-news']], function () {
    Route::get('news/{id}/approve/{approve}', 'NewsController@approve')->middleware('permission:approve-news');
});

//Games Routen
Route::resource('games', 'GameController');
Route::post('games/{id}/developer', 'GameController@store_developer')->name('games.developer.store')->middleware('permission:create-games');
Route::post('games/{id}/developer/delete', 'GameController@destroy_developer')->name('games.developer.delete')->middleware('permission:create-games');

//Gamefiles routen
Route::get('games/{id}/gamefiles', 'GameFileController@create')->name('gamefiles.index');
Route::post('games/{id}/gamefiles', 'GameFileController@store')->name('gamefiles.store')->middleware('permission:create-games');
Route::post('games/{id}/gamefiles/upload', 'FineUploaderController@endpoint')->name('gamefiles.upload')->middleware('permission:create-games');
Route::get('games/{id}/gamefiles/delete/{fileid}', 'GameFileController@destroy')->name('gamefiles.delete')->middleware('permission:admin-games');
Route::get('games/{id}/gamefiles/edit/{gamefileid}', 'GameFileController@edit')->name('gamefiles.edit')->middleware('permission:create-games');
Route::post('games/{id}/gamefiles/edit/{gamefileid}/update', 'GameFileController@update')->name('gamefiles.update')->middleware('permission:create-games');
Route::get('games/download/{id}/{ts?}', 'GameFileController@download')->name('gamefiles.download');
Route::get('games/{gameid}/screenshot/show/{screenid}/{full?}', 'ScreenshotController@show')->name('screenshot.show');
Route::get('games/{gameid}/screenshot/create/{screenid}', 'ScreenshotController@create')->name('screenshot.create')->middleware('permission:create-game-screenshots');
Route::post('games/{gameid}/screenshot/upload/{screenid}', 'ScreenshotController@upload')->name('screenshot.upload')->middleware('permission:create-game-screenshots');
Route::get('games/index/{orderby?}/{direction?}', 'GameController@index')->name('games.index.sorted');
Route::get('games/restoregamefile/{gamefileid}', 'GameFileController@restore')->name('gamefiles.restore');

Route::post('gameupload', '\Optimus\FineuploaderServer\Controller\LaravelController@upload')->middleware('permission:create-games');
Route::delete('gameupload/delete/{uuid}', '\Optimus\FineuploaderServer\Controller\LaravelController@delete')->middleware('permission:create-games');
Route::get('gameupload/session', '\Optimus\FineuploaderServer\Controller\LaravelController@session')->middleware('permission:create-games');

//History Routen
Route::get('history/game/{id}', 'HistoryController@index')->name('history.game.index');

//Routen für Maker Seiten
Route::get('makers/{orderby?}/{direction?}', 'MakerController@index')->name('maker.index.sorted');
Route::get('maker/{makerid}/{orderby?}/{direction?}', 'MakerController@show')->name('maker.show');

//Reporting Routen
Route::get('reports/add/game/{gameid}', 'ReportController@create_game_report');
Route::post('reports/add/game/{gameid}', 'ReportController@store_game_report')->name('game-report.store');
Route::get('reports', 'ReportController@index_user');
Route::get('reports/close/{id}', 'ReportController@close_ticket');
Route::get('reports/open/{id}', 'ReportController@open_ticket');
Route::get('reports/remark/{id}', 'ReportController@remark_ticket');

//Gamecredits routen
Route::post('games/{id}/credit', 'UserCreditsController@store')->name('gamecredits.store')->middleware('permission:create-games');
Route::get('games/{id}/credit/{credit_id}/delete', 'UserCreditsController@destroy')->name('gamecredits-delete')->middleware('permission:create-games');

//Suchrouten
Route::get('search', 'SearchController@index');
Route::get('search/{orderby?}/{direction?}/{query?}', 'SearchController@index');
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

    Route::post('/create', ['as' => 'resources.create_steps', 'uses' => 'ResourceController@create_steps'])->middleware('permission:create-games');
    Route::get('/create', ['as' => 'resources.create', 'uses' => 'ResourceController@create'])->middleware('permission:create-games');
    Route::post('/create/store', ['as' => 'resources.store', 'uses' => 'ResourceController@store'])->middleware('permission:create-games');
});

Route::post('resources/upload', 'FineUploaderController@endpoint@upload')->name('resources.upload')->middleware('permission:create-games');

//User Routings
Route::get('users', 'UserController@index');
Route::get('users/activity', 'UserController@activity_index');
Route::get('users/online', 'UserController@users_online');
Route::get('users/{id}', 'UserController@show')->name('users.show');

//PN Routen
Route::group(['prefix' => 'messages', 'middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

//Comment routings
Route::post('comment', 'CommentController@add')->middleware('permission:create-news-comments|create-game-comments');
Route::post('comment/delete/{comment_id}', 'CommentController@delete')->middleware('permission:admin-comments');
Route::post('comment/restore/{comment_id}', 'CommentController@restore')->middleware('permission:admin-comments');

//Logo Voting
Route::get('logo/vote', 'LogoController@vote_get')->name('logo.vote')->middleware('auth');
Route::post('logo/vote/{userid}', 'LogoController@vote_add')->middleware('auth');

//Logo Admin
Route::get('logo/admin', 'LogoController@admin')->middleware('permission:admin-games');
Route::get('logo/admin/delete/{id}', 'LogoController@delete')->middleware('permission:admin-games');

//Submit Routen
Route::get('submit', 'SubmitController@index')->middleware('auth');

//Logo Routen
Route::get('submit/logo', 'SubmitController@logo_index')->middleware('auth');
Route::post('submit/logo', 'SubmitController@logo_add')->middleware('auth');

//Shoutbox Routen
Route::post('shoutbox', 'ShoutboxController@store')->middleware('permission:create-shoutbox');
Route::get('shoutbox', 'ShoutboxController@index');

//Routen für Forum/Board
Route::get('board', 'BoardController@index')->name('board.show');
Route::get('board/create', 'BoardController@create_cat')->name('board.cat.create')->middleware('permission:admin-board');
Route::post('board/create', 'BoardController@store_cat')->name('board.cat.store')->middleware('permission:admin-board');
Route::get('board/cat/{catid}', 'BoardController@show_cat')->name('board.cat.show');
Route::get('board/cat/{catid}/{direction}', 'BoardController@order_cat')->name('board.cat.order');
Route::get('board/cat/{catid}/thread/create', 'BoardController@create_thread')->name('board.thread.create')->middleware('permission:create-threads');
Route::post('board/thread/create', 'BoardController@store_thread')->name('board.thread.store')->middleware('permission:create-threads');
Route::get('board/thread/{threadid}/edit/{postid}', 'BoardController@post_edit')->name('board.post.edit')->middleware('permission:create-posts');
Route::post('board/thread/{threadid}/edit/{postid}', 'BoardController@post_update')->name('board.post.update')->middleware('permission:create-posts');
Route::get('board/thread/{threadid}', 'BoardController@show_thread')->name('board.thread.show');
Route::post('board/thread/{threadid}', 'BoardController@store_post')->name('board.post.store')->middleware('permission:create-posts');
Route::get('board/thread/{id}/switchclosestate/{state}', 'BoardController@thread_close_switch')->name('board.thread.switch.close')->middleware('permission:mod-threads');
Route::get('board/thread/{threadid}/vote/create', 'BoardController@create_vote')->name('board.vote.create')->middleware('permission:create-threads');
Route::post('board/thread/{threadid}/vote/store', 'BoardController@store_vote')->name('board.vote.store')->middleware('permission:create-threads');
Route::post('board/thread/{threadid}/vote/update', 'BoardController@update_vote')->name('board.vote.update')->middleware('permission:create-threads');
Route::post('board/thread/vote/add', 'BoardController@add_vote')->name('board.vote.add')->middleware('permission:create-threads');

//Routen für FAQ
Route::get('faq', 'FaqController@index');
Route::get('faq/create', 'FaqController@create')->middleware('permission:create-faq');
Route::post('faq', 'FaqController@store')->middleware('permission:create-faq');

//Routen für Awards
Route::get('awards', 'AwardController@index')->name('awards.index');
Route::get('awards/create', 'AwardController@create')->name('awards.create')->middleware('permission:create-games');
Route::get('awards/gameadd/{subcatid}', 'AwardController@gameadd')->name('awards.gameadd')->middleware('permission:create-games');
Route::get('awards/{awardid}', 'AwardController@show')->name('awards.show');
Route::post('awards/store/page', 'AwardController@store_page')->middleware('permission:create-games');
Route::post('awards/store/cat', 'AwardController@store_cat')->middleware('permission:create-games');
Route::post('awards/store/subcat', 'AwardController@store_subcat')->middleware('permission:create-games');
Route::post('awards/gameadd/', 'AwardController@gameadd_store')->middleware('permission:create-games');

//Routen für Userlisten
Route::get('lists/create', 'UserListController@create')->middleware('auth');
Route::post('lists/create', 'UserListController@store')->middleware('auth');
Route::get('lists/{userid}', 'UserListController@index');
Route::get('lists/{listid}/add_game/{gameid}', 'UserListController@add_game')->name('lists.add_game')->middleware('auth');
Route::get('lists/{userid}/show/{listid}', 'UserListController@show')->name('userlist.show');
Route::get('lists/{listid}/delete/game/{itemid}', 'UserListController@delete_game')->name('lists.delete_game')->middleware('auth');
Route::get('lists/delete/{listid}', 'UserListController@delete')->middleware('auth');

//Autocomplete Routen
Route::get('ac_developer/{term}', 'AutocompleteController@developer');
Route::get('ac_games/{term}', 'AutocompleteController@game');
Route::get('ac_faqcat/{term}', 'AutocompleteController@faqcat');
Route::get('ac_award_page/{term}', 'AutocompleteController@awardpage');
Route::get('ac_award_cat/{term}', 'AutocompleteController@awardcat');
Route::get('ac_award_subcat/{term}', 'AutocompleteController@awardsubcat');
Route::get('ac_user/{term}', 'AutocompleteController@user');
Route::get('ac_search/{term}', 'AutocompleteController@search');

//Routen für Messageboxen
Route::get('submit/logo/success', 'MsgBoxController@submit_logo')->name('submit.logo.success');
Route::get('comment/success/{type}/{id}', 'MsgBoxController@comment_add')->name('news.comment.add.success');
Route::get('games/success/{id}', 'MsgBoxController@game_add')->name('game.add.success');
Route::get('screenshot/upload/success/{gameid}', 'MsgBoxController@screenshot_add')->name('screenshot.upload.success');
Route::get('cdc/success/{gameid}', 'MsgBoxController@cdc_add');

//Routen für Fehlendes oder Statistiken
Route::get('missing/gamescreens/{orderby?}/{direction?}', 'MissingController@index_gamescreens')->middleware('permission:admin-games');
Route::get('missing/gamefiles/{orderby?}/{direction?}', 'MissingController@index_gamefiles')->middleware('permission:admin-games');
Route::get('missing/gamedesc/{orderby?}/{direction?}', 'MissingController@index_gamedesc')->middleware('permission:admin-games');
Route::get('missing/notags/{orderby?}/{direction?}', 'MissingController@index_notags')->middleware('permission:admin-games');

//Sonstige Seiten
Route::get('/impressum', function () {
    return View::make('_pages.impressum');
});
Route::get('/datenschutz', function() {
    return View::make('_pages.datenschutz');
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
Route::post('tags/create', 'TaggingController@store')->middleware('permission:create-games');
Route::get('tags/game/{id}/{orderby?}/{direction?}', 'TaggingController@showGames');
Route::get('tags', 'TaggingController@index');
Route::get('tags/{orderby?}/{direction?}', 'TaggingController@index')->name('tags.index.sorted');
Route::get('tags/delete/game/{gameid}/{tagid}', 'TaggingController@delete_gametag')->middleware('permission:create-games');

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

//Attachment Routen
Route::post('attachment/upload', 'SubmitController@attachment_submit');

//Spezialrouten
Route::post('tako/downlbla', 'GameFileController@download_wo_count');
Route::get('test', 'TestController@index');
Route::post('tlg/webhook', 'TestController@webhook');

//Logo Routen
Route::get('logo/{filename}', function ($filename) {
    $filename = 'logos/'.$filename;
    $path = Storage::get($filename);

    $img = \Image::make($path);
    $response = \Response::make($img->encode('png'));
    $response->header('Content-Type', 'image/png');
    //$response->setMaxAge(604800);
    $response->setPublic();

    return $response;
})->name('logo.get');

Route::get('easyrpg/download/{hash}', function ($hash) {
    $filename = 'app/public/games_hashed/'.substr($hash, 0, 2).'/'.$hash;
    $path = storage_path($filename);

    return response()->download($path, $hash, ['Content-Type' => 'application/octet-stream']);
});

Route::group(['middleware' => 'permission:translate-page'], function () {
    Route::get('translation', 'TranslationController@index')->name('trans.index');
    Route::get('translation/{loc1}/{loc2?}/{viewtype?}/{searchterm?}', 'TranslationController@edit')->name('trans.edit');
    Route::post('translation/save', 'TranslationController@savestring')->name('trans.save');
});

// EasyRPG Player (2k/2k3) Routen
Route::get('player/{gamefileid}/games/default/index.json', 'Player2kController@deliver_indexjson')->name('player.deliverindex')->middleware('auth');
Route::get('player/{gamefileid}/games/default/{fileid}', 'Player2kController@deliver_files')->name('player.files')->middleware('auth');
Route::get('player/{gamefileid}/games/default/rtp/{filename}', 'Player2kController@deliver_rtp')->name('player.rtp')->middleware('auth');
Route::get('player/{gamefileid}/play', 'Player2kController@index')->name('player.run')->middleware('auth');

// RPG Maker MV Player Routen
Route::get('playermv/{gamefileid}/play', 'PlayerMvController@index')->name('playermv.run')->middleware('auth');
Route::get('playermv/{gamefileid}/{filename}', 'PlayerMvController@deliver')->name('playermv.deliver')->middleware('auth')->where('filename', '.*');

//EasyRPG Player Ticketsystem
Route::post('easyticket/storeconsole', 'EasyTicketController@store_consolelog')->middleware('auth');

//Savegame Management
Route::get('savegames/manager', 'SavegameManagerController@index')->middleware('auth');
Route::get('savegames/manager/game/{gamefile_id}', 'SavegameManagerController@show')->middleware('auth');
Route::get('savegames/manager/save/{savegame_id}/delete', 'SavegameManagerController@delete')->middleware('auth');
Route::get('savegames/manager/save/{savegame_id}/download', 'SavegameManagerController@download')->middleware('auth');
Route::post('savegame/manager/save/upload', 'SavegameManagerController@store')->middleware('auth');

// Web Player Savegame API
Route::get('savegames/{gamefileid}', 'SavegameController@api_load')->middleware('auth');
Route::post('savegames/{gamefileid}', 'SavegameController@api_save')->middleware('auth');
Route::post('savegames/{gamefileid}/{slot}', 'SavegameController@api_save_slot')->middleware('auth');

Route::get('data/on', 'TestController@on');
Route::get('data/off', 'TestController@off');
Route::get('data/onoff', 'TestController@onoff');
