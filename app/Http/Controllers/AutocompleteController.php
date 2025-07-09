<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Game;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AutocompleteController extends Controller
{
    /**
     * returns autocomplete values for games
     * @param $term
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($term)
    {
        $result = [];

        $games = Game::search($term)->get();

        foreach ($games as $g) {
            $result[] = [
                'id'    => $g->id,
                'title' => $g->title,
                'value' => \View::make('_partials.inline_gamebox', ['game' => $g])->render(),
            ];
        }

        return \Response::json($result);
    }
    /**
     *
     * returns autocomplete values for games as json
     * @param $term
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchNew($term)
    {
        $result = [];
        $games = Game::search($term)->get();
        // Simple dev game search - check performance
        $developers = Developer::search($term)->get();

        foreach ($developers->reverse()->values() as $developer) {
            $devGames = Game::with('developers')
            ->select(
                    'games.id as id',
                    'games.title as title',
                    'games.subtitle as subtitle',
                    'games.desc_md as desc_md',
                    'games.desc_html as desc_html',
                    'games.website_url as website_url',
                    'games.user_id as user_id',
                    'games.views as views',
                    'games.release_date as release_date',
                    'games.maker_id as maker_id',
                    'games.deleted_at as deleted_at',
                    'games.created_at as created_at',
                    'games.updated_at as updated_at',
                    'games.lang_id as lang_id',
                    'games.atelier_id as atelier_id',
                    'games.release_type as release_type',
                    'games.voteup as voteup',
                    'games.votedown as votedown',
                    'games.avg as avg',
                    'games.comments as comments',
                    'games.desc_md_translation as desc_md_translation',
                    'games.is_banned as is_banned',
                    'games.is_banned_reason as is_banned_reason',
                    'games.is_banned_at as is_banned_at',
                    'games.invisible_on_start_page as invisible_on_start_page',
                    'games.client_visible as client_visible',
                    'games.nsfw as nsfw',)
                ->leftJoin('games_developer as gd', 'gd.game_id', '=', 'games.id')
                ->join('developer', 'gd.developer_id', '=', 'developer.id')
                ->where('gd.developer_id', '=', $developer->id)->get();
            $games = $devGames->merge($games);
        }
        // TODO: Alternative - Compare performance with  - Update similar performance
        // foreach ($developers->reverse()->values() as $developer) {
        //     $idArray = Game::with('developers')
        //         ->select(
        //             'games.id as id')
        //         ->leftJoin('games_developer as gd', 'gd.game_id', '=', 'games.id')
        //         ->join('developer', 'gd.developer_id', '=', 'developer.id')
        //         ->where('gd.developer_id', '=', $developer->id)->get()->toArray();
        //     $devGamesId = array_map(
        //         function($gameData) {return $gameData['id'];},
        //         $idArray);
        //     $devGames = Game::whereIn('id', $devGamesId)->get();
        //     $games = $devGames->merge($games);
        // }

        foreach ($games as $g) {
            $result[] = [
                'link'   => url('games', $g->id),
                'comments'   => $g->comments,
                'gameTypeShort' => $g?->gamefiles?->first()?->gamefiletype?->short,
                'gameType' => $g?->gamefiles?->first()?->gamefiletype?->title,

                'maker' => $g->maker->title,
                'makerShort' => $g->maker->short,

                'languageIconURLSegment' => strtoupper($g->language->short),
                'language' => $g->language->name,

                "urlGame" => action('GameController@show', $g->id),
                'makerLink' => route('maker.show', $g->maker->id),

                'id'    => $g->id,
                "subtitle" => $g->subtitle,
                'title' => $g->title,
                'description' => $g->desc_md,

                'developers' => \App\Helpers\DatabaseHelper::getDevelopersList($g->id),

                'release' => \Carbon\Carbon::parse(\App\Helpers\DatabaseHelper::getReleaseDateFromGameId($g->id))->toDateString(),
                // 'created' => \Carbon\Carbon::parse($g->created_at)->diffForHumans(),

                'votesUp' => $g->voteup ?? 0,
                'votesDown' => $g->votedown ?? 0,

                'tags' => $g->tags,
                'hasCdc' => $g->cdcs->count() > 0,
                'screenshot' => route('screenshot.show', [$g->id, 1]),
                'value' => "",
                'average' => number_format(floatval($g->avg), 2),
                'translation' => array(
                    'titleScreenAlt' => trans('app.titlescreen'),
                    'coupdecoeur' => trans('app.coupdecoeur'),
                    'released' => trans('app.release_date'),
                    'created' => trans('app.addition_date'),
                    'rate_up' => trans('app.rate_up'),
                    'rate_neut' => trans('app.rate_neut'),
                    'rate_down' => trans('app.rate_down'),
                ),
            ];
        }

        return \Response::json($result);
    }

    public function developer($term)
    {
        $result = [];

        $devs = Developer::where('name', 'like', '%'.$term.'%')->get();

        foreach ($devs as $dev) {
            $result[] = ['id' => $dev->id, 'value' => $dev->name];
        }

        return \Response::json($result);
    }

    public function game($term)
    {
        $result = [];

        $games = \DB::table('games')
            ->select([
                'id',
                'title',
                'subtitle',
            ])
            ->where('title', 'like', '%'.$term.'%')
            ->orWhere('subtitle', 'like', '%'.$term.'%')
            ->get();

        foreach ($games as $g) {
            if (is_null($g->subtitle) || $g->subtitle == '') {
                $result[] = ['id' => $g->id, 'value' => $g->title];
            } else {
                $result[] = ['id' => $g->id, 'value' => $g->title.' -=- '.$g->subtitle];
            }
        }

        return \Response::json($result);
    }

    public function faqcat($term)
    {
        $result = [];

        //$devs = Developer::whereName($term)->get();
        $devs = \DB::table('faq')
            ->select(['id', 'cat'])
            ->where('faq.cat', 'like', '%'.$term.'%')
            ->groupBy('faq.cat')
            ->get();

        foreach ($devs as $dev) {
            $result[] = ['id' => $dev->id, 'value' => $dev->cat];
        }

        return \Response::json($result);
    }

    public function awardpage($term)
    {
        $result = [];
        $aw = \DB::table('award_pages')->get();

        foreach ($aw as $item) {
            $result[] = [
                'id'    => $item->id,
                'value' => $item->title,
            ];
        }

        return \Response::json($result);
    }

    public function awardcat($term)
    {
        $result = [];
        $aw = \DB::table('award_cats')->get();

        foreach ($aw as $item) {
            $result[] = [
                'id'    => $item->id,
                'value' => $item->title,
            ];
        }

        return \Response::json($result);
    }

    public function awardsubcat($term)
    {
        $result = [];
        $aw = \DB::table('award_subcats')->get();

        foreach ($aw as $item) {
            $result[] = [
                'id'    => $item->id,
                'value' => $item->title,
            ];
        }

        return \Response::json($result);
    }

    public function user($term)
    {
        $result = [];
        $users = User::where('name', 'like', '%'.$term.'%')->get();

        foreach ($users as $user) {
            $result[] = [
                'id'    => $user->id,
                'value' => $user->name,
            ];
        }

        return \Response::json($result);
    }

    public function tag($term)
    {
        $result = [];
        $tags = Tag::where('title', 'like', '%'.$term.'%')->get();

        foreach ($tags as $tag) {
            $result[] = [
                'id'    => $tag->id,
                'value' => $tag->title,
            ];
        }

        return \Response::json($result);
    }
}
