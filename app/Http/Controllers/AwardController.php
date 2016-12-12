<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function index(){

        $awards = \DB::table('award_cats')
            ->leftJoin('award_pages', 'award_cats.award_page_id', '=', 'award_pages.id')
            ->select([
                'award_cats.id as id',
                'award_cats.title as title',
                'award_cats.year as year',
                'award_cats.month as month',
                'award_pages.title as awardpage'
            ])
            ->get();

        return view('awards.index', [
            'awards' => $awards,
        ]);
    }

    public function show($awardid){

        return view('awards.show', [

        ]);
    }
}
