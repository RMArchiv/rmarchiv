<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Developer;
use App\Models\GamesFile;
use App\Models\UserOnline;
use App\Models\BoardThread;
use App\Models\BoardThreadsTracker;

class DatabaseHelper
{
    public static function setVotesAndComments($gameid)
    {
        $game = Game::whereId($gameid)->first();

        Game::whereId($gameid)
            ->update([
                'voteup'   => $game->votes['up'],
                'votedown' => $game->votes['down'],
                'avg'      => $game->votes['avg'],
                'comments' => $game->comments()->count(),
            ]);
    }

    public static function setReleaseInfos($gameid)
    {
        $game = Game::find($gameid);

        $reltype = 99;
        $reldate = Carbon::create();

        //prüfen ob Techdemo existiert
        $gamefiles = GamesFile::whereGameId($gameid)
            ->where('release_type', '=', 1)
            ->orderBy('release_year', 'ASC')
            ->orderBy('release_month', 'ASC')
            ->orderBy('release_day', 'ASC')
            ->first();

        if ($gamefiles) {
            $reltype = $gamefiles->release_type;
            $reldate = Carbon::parse($gamefiles->release_year.'-'.$gamefiles->release_month.'-'.$gamefiles->release_day);
        }

        //Prüfen ob Demo vorhanden
        $gamefiles = GamesFile::whereGameId($gameid)
            ->where('release_type', '=', 2)
            ->orderBy('release_year', 'ASC')
            ->orderBy('release_month', 'ASC')
            ->orderBy('release_day', 'ASC')
            ->first();

        if ($gamefiles) {
            $reltype = $gamefiles->release_type;
            $reldate = Carbon::parse($gamefiles->release_year.'-'.$gamefiles->release_month.'-'.$gamefiles->release_day);
        }

        //Prüfen ob Vollversion vorhanden.
        $gamefiles = GamesFile::whereGameId($gameid)
            ->where('release_type', '=', 3)
            ->orderBy('release_year', 'ASC')
            ->orderBy('release_month', 'ASC')
            ->orderBy('release_day', 'ASC')
            ->first();

        if ($gamefiles) {
            $reltype = $gamefiles->release_type;
            $reldate = Carbon::parse($gamefiles->release_year.'-'.$gamefiles->release_month.'-'.$gamefiles->release_day);
        }

        if ($game->release_type == $reltype) {
            if (Carbon::parse($game->release_date) > $reldate) {
                Game::whereId($gameid)
                    ->update([
                        'release_date' => $reldate,
                    ]);
            }
        } else {
            Game::whereId($gameid)
                ->update([
                    'release_date' => $reldate,
                    'release_type' => $reltype,
                ]);
        }
    }

    public static function getOnlineUserCount()
    {
        $users = \DB::table('user_online')
            ->selectRaw('COUNT(id) as online')
            ->where('created_at', '>=', Carbon::now()->addMinutes(-10))
            ->first();

        return $users;
    }

    public static function setOnline($where)
    {
        if (\Auth::check()) {
            UserOnline::updateOrInsert([
                'user_id' => \Auth::id(),
            ], [
                    'last_place' => $where,
                    'created_at' => Carbon::now(),
                ]
            );
        }
    }

    public static function isThreadUnread($thread_id)
    {
        if (\Auth::check()) {
            $track = BoardThreadsTracker::where('thread_id', '=', $thread_id)
                ->where('user_id', '=', \Auth::id())->first();

            $thread = BoardThread::whereId($thread_id)->first();

            if ($track) {
                if (Carbon::parse($track->last_read)->timestamp < Carbon::parse($thread->last_created_at)->timestamp) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public static function setThreadViewDate($thread_id)
    {
        if (\Auth::check()) {
            $track = BoardThreadsTracker::updateOrInsert([
                'user_id'   => \Auth::id(),
                'thread_id' => $thread_id,
            ], [
                'last_read' => Carbon::now(),
            ]);
        }
    }

    public static function getReleaseDateFromGameId($gameid)
    {
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
            } else {
                return '';
            }
        } else {
            return Carbon::parse($game->release_date)->toDateString();
        }
    }

    public static function getDevelopersUrlList($gameid, $urlstyle = true)
    {
        $developers = \DB::table('games_developer')
            ->leftJoin('developer', 'developer.id', '=', 'games_developer.developer_id')
            ->where('games_developer.game_id', '=', $gameid)
            ->get();

        $res = '';
        foreach ($developers as $dev) {
            if ($urlstyle == true) {
                $res = $res.'<a href="'.url('developer', $dev->id).'">'.$dev->name.'</a> :: ';
            } else {
                $res .= $dev->name.', ';
            }
        }

        $res = substr($res, 0, -4);

        return $res;
    }

    public static function getResourcePathArray($id)
    {
        $resource = \DB::table('resources')
            ->where('id', '=', $id)
            ->first();

        $res = [
            'type' => $resource->type,
            'cat'  => $resource->cat,
            'id'   => $id,
        ];

        return $res;
    }

    public static function getObyxPoints($reason)
    {
        $obyx = \DB::table('obyx')
            ->where('reason', '=', $reason)
            ->first();

        return $obyx->value;
    }

    public static function getGameViewsMax()
    {
        $v = \DB::table('games')
            ->selectRaw('MAX(views) as maxviews')
            ->first();

        return $v->maxviews;
    }

    /**
     * @param string $type
     */
    public static function getCommentsMax($type)
    {
        $v = \DB::table('comments')
            ->selectRaw('count(id) as maxviews')
            ->where('content_type', '=', \DB::raw("'".$type."'"))
            ->first();

        return $v->maxviews;
    }

    public static function langId_from_short($short)
    {
        $lang = \DB::table('languages')
            ->select('id')
            ->where('short', '=', $short)
            ->first();

        if ($lang) {
            return $lang->id;
        } else {
            return 0;
        }
    }

    public static function developerId_from_developerName($developername)
    {
        $dev = \DB::table('developer')
            ->select('id')
            ->where('name', '=', $developername)
            ->first();

        if ($dev) {
            return $dev->id;
        } else {
            return 0;
        }
    }

    public static function developer_add_and_get_developerId($developername)
    {
        $d = new Developer();
        $d->name = $developername;
        $d->user_id = \Auth::id();
        $d->save();

        return $d->id;
    }
}
