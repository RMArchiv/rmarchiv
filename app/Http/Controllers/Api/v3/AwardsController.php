<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\AwardCat;
use App\Models\AwardPage;
use App\Models\AwardSubcat;
use App\Models\GamesAward;
use App\Models\GamesCoupdecoeur;
use Illuminate\Http\Request;

class AwardsController extends Controller
{
    public function pages()
    {
        \Debugbar::disable();

        $pages = AwardPage::orderBy('title')->get();

        return response()->json([
            'status_code' => 200,
            'message' => 'Award pages',
            'data' => $pages,
        ]);
    }

    public function cats(Request $request)
    {
        \Debugbar::disable();

        $query = AwardCat::orderBy('year', 'desc')->orderBy('month', 'desc');
        $pageId = (int) $request->query('page_id', 0);
        if ($pageId > 0) {
            $query->where('award_page_id', '=', $pageId);
        }

        $cats = $query->get();

        return response()->json([
            'status_code' => 200,
            'message' => 'Award categories',
            'data' => $cats,
        ]);
    }

    public function subcats(Request $request)
    {
        \Debugbar::disable();

        $query = AwardSubcat::orderBy('title');
        $catId = (int) $request->query('cat_id', 0);
        if ($catId > 0) {
            $query->where('cat_id', '=', $catId);
        }

        $subcats = $query->get();

        return response()->json([
            'status_code' => 200,
            'message' => 'Award subcategories',
            'data' => $subcats,
        ]);
    }

    public function gameAwards($gameId)
    {
        \Debugbar::disable();

        $awards = GamesAward::with(['page', 'cat', 'subcat'])
            ->where('game_id', '=', $gameId)
            ->orderBy('place')
            ->get()
            ->map(function (GamesAward $award) {
                return [
                    'id' => $award->id,
                    'place' => $award->place,
                    'description' => $award->description,
                    'page' => $award->page ? [
                        'id' => $award->page->id,
                        'title' => $award->page->title,
                        'short' => $award->page->short,
                    ] : null,
                    'cat' => $award->cat ? [
                        'id' => $award->cat->id,
                        'title' => $award->cat->title,
                        'year' => $award->cat->year,
                        'month' => $award->cat->month,
                    ] : null,
                    'subcat' => $award->subcat ? [
                        'id' => $award->subcat->id,
                        'title' => $award->subcat->title,
                    ] : null,
                ];
            });

        return response()->json([
            'status_code' => 200,
            'message' => 'Game awards',
            'data' => $awards,
        ]);
    }

    public function gameCdcs($gameId)
    {
        \Debugbar::disable();

        $cdcs = GamesCoupdecoeur::with('user')
            ->where('game_id', '=', $gameId)
            ->get()
            ->map(function (GamesCoupdecoeur $cdc) {
                return [
                    'id' => $cdc->id,
                    'user' => $cdc->user ? [
                        'id' => $cdc->user->id,
                        'name' => $cdc->user->name,
                    ] : null,
                    'created_at' => $cdc->created_at,
                ];
            });

        return response()->json([
            'status_code' => 200,
            'message' => 'Game coup de coeur',
            'data' => $cdcs,
        ]);
    }
}
