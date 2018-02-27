<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AwardCat;
use App\Models\AwardSubcat;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index()
    {
        $awards = AwardCat::orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('awards.index', [
            'awards' => $awards,
        ]);
    }

    public function show($awardid)
    {
        $award = AwardCat::whereId($awardid)->first();

        return view('awards.show', [
            'award' => $award,
        ]);
    }

    public function create()
    {
        $pages = \DB::table('award_pages')
            ->orderBy('title')
            ->get();

        $awards = \DB::table('award_cats')
            ->leftJoin('award_pages', 'award_pages.id', '=', 'award_cats.award_page_id')
            ->select([
                'award_cats.id as catid',
                'award_pages.id as pageid',
                'award_pages.title as pagetitle',
                'award_cats.title as cattitle',
                'award_cats.year as year',
                'award_cats.month as month',
            ])
            ->orderBy('award_cats.year')
            ->orderBy('award_cats.month')
            ->orderBy('award_cats.title')
            ->get();

        return view('awards.create', [
            'pages' => $pages,
            'awards' => $awards,
        ]);
    }

    public function gameadd($subcatid)
    {
        $awardcat = AwardSubcat::whereCatId($subcatid)->first();
        // Get award model from catid.
        $award = AwardCat::whereId($awardcat->cat_id)->first();

        return view('awards.gameadd', [
            'subcatid' => $subcatid,
            'award' => $award,
        ]);
    }

    public function gameadd_store(Request $request)
    {
        $this->validate($request, [
            'game' => 'required|numeric',
            'place' => 'required|numeric',
            'subcatid' => 'required|numeric',
        ]);

        $subcat = \DB::table('award_subcats')
            ->where('id', '=', $request->get('subcatid'))
            ->first();

        $check = \DB::table('games_awards')
            ->where('award_subcat_id', '=', $request->get('subcatid'))
            ->where('game_id', '=', $request->get('game'))
            ->get();

        //dd($check);

        if ($check->count() == 0) {
            \DB::table('games_awards')->insert([
                'game_id' => $request->get('game'),
                'developer_id' => 0,
                'award_cat_id' => $subcat->cat_id,
                'award_page_id' => $subcat->page_id,
                'user_id' => \Auth::id(),
                'created_at' => Carbon::now(),
                'place' => $request->get('place'),
                'description' => $request->get('desc'),
                'award_subcat_id' => $request->get('subcatid'),
            ]);
        }

        return redirect()->action('AwardController@show', $subcat->cat_id);
    }

    public function store_page(Request $request)
    {
        $this->validate($request, [
            'awardpage' => 'required',
        ]);

        $check = \DB::table('award_pages')
            ->where('title', '=', $request->get('awardpage'))
            ->get();

        if ($check->count() == 0) {
            \DB::table('award_pages')->insert([
                'title' => $request->get('awardpage'),
                'website_url' => $request->get('awardpageurl'),
                'user_id' => \Auth::id(),
                'created_at' => Carbon::now(),
            ]);
        }

        return redirect()->action('AwardController@create');
    }

    public function store_cat(Request $request)
    {
        $this->validate($request, [
            'awardpage' => 'required|not_in:0',
            'awardname' => 'required',
            'awarddate_year' => 'required|not_in:0',
        ]);

        $check = \DB::table('award_cats')
            ->where('title', '=', $request->get('awardname'))
            ->where('year', '=', $request->get('awarddate_year'))
            ->where('month', '=', $request->get('awarddate_month'))
            ->where('award_page_id', '=', $request->get('awardpage'))
            ->get();

        if ($check->count() == 0) {
            \DB::table('award_cats')->insert([
                'title' => $request->get('awardname'),
                'award_page_id' => $request->get('awardpage'),
                'year' => $request->get('awarddate_year'),
                'month' => $request->get('awarddate_month'),
                'user_id' => \Auth::id(),
                'created_at' => Carbon::now(),
            ]);
        }

        return redirect()->action('AwardController@create');
    }

    public function store_subcat(Request $request)
    {
        $this->validate($request, [
            'award' => 'required|not_in:0',
            'awardsubcat' => 'required',
        ]);

        $aw = explode('-', $request->get('award'));

        $check = \DB::table('award_subcats')
            ->where('cat_id', '=', $aw[1])
            ->where('page_id', '=', $aw[0])
            ->where('title', '=', $request->get('awardsubcat'))
            ->get();

        if ($check->count() == 0) {
            \DB::table('award_subcats')->insert([
                'title' => $request->get('awardsubcat'),
                'created_at' => Carbon::now(),

                'cat_id' => $aw[1],
                'page_id' => $aw[0],
            ]);
        }

        return redirect()->action('AwardController@create');
    }
}
