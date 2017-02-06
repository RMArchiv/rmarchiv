<?php

namespace App\Helpers;

use App\Models\Developer;
use App\Models\Game;
use App\Models\GamesFile;
use Carbon\Carbon;

class DatabaseHelper {

    public static function getReleaseDateFromGameId($gameid) {
        $game = Game::whereId($gameid)->first();

        if (is_null($game)) {
            return '';
        }

        if (Carbon::parse($game->release_date)->year == -1 || is_null($game->release_date)) {
            $releasedate = GamesFile::whereGameId($gameid)
                ->selectRaw('CONCAT(release_year, "-", LPAD(release_month, 2, "0"), "-", release_day) as reldate')
                ->orderBy('release_type', 'desc')
                ->orderBy('reldate', 'asc')
                ->first();

            if ($releasedate) {
                return Carbon::parse($releasedate->reldate)->toDateString();
            }else {
                return '';
            }

        }else {
            return Carbon::parse($game->release_date)->toDateString();
        }
    }

    public static function getDevelopersUrlList($gameid) {
        $developers = \DB::table('games_developer')
            ->leftJoin('developer', 'developer.id', '=', 'games_developer.developer_id')
            ->where('games_developer.game_id', '=', $gameid)
            ->get();

        $res = '';
        foreach ($developers as $dev) {
            $res = $res.'<a href="'.url('developer', $dev->id).'">'.$dev->name.'</a> :: ';
        }

        $res = substr($res, 0, -4);

        return $res;
    }

    public static function getResourcePathArray($id) {
        $resource = \DB::table('resources')
            ->where('id', '=', $id)
            ->first();

        $res = [
            'type' => $resource->type,
            'cat' => $resource->cat,
            'id' => $id,
        ];

        return $res;
    }

    public static function getObyxPoints($reason) {
        $obyx = \DB::table('obyx')
            ->where('reason', '=', $reason)
            ->first();

        return $obyx->value;
    }

    public static function getGameViewsMax() {
        $v = \DB::table('games')
            ->selectRaw('MAX(views) as maxviews')
            ->first();

        return $v->maxviews;
    }

    /**
     * @param string $type
     */
    public static function getCommentsMax($type){
        $v = \DB::table('comments')
            ->selectRaw('count(id) as maxviews')
            ->where('content_type', '=', \DB::raw("'".$type."'"))
            ->first();

        return $v->maxviews;
    }

    public static function langId_from_short($short) {
        $lang = \DB::table('languages')
            ->select('id')
            ->where('short', '=', $short)
            ->first();

        if ($lang) {
            return $lang->id;
        }else {
            return 0;
        }

    }

    public static function developerId_from_developerName($developername) {
        $dev = \DB::table('developer')
            ->select('id')
            ->where('name', '=', $developername)
            ->first();

        if ($dev) {
            return $dev->id;
        }else {
            return 0;
        }

    }

    public static function developer_add_and_get_developerId($developername) {
        $d = new Developer;
        $d->name = $developername;
        $d->user_id = \Auth::id();
        $d->save();

        return $d->id;
    }

}