<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(){

    }

    public function show_cat($catid){

    }

    public function create_cat(){

        $cats = \DB::table('board_cats')
            ->select([
                'id as catid',
                'title as cattitle',
                'order as catorder',
                'created_at as catdate',
            ])
            ->selectRaw('(SELECT COUNT(id) FROM board_threads WHERE cat_id = board_cats.id) as catthreads')
            ->selectRaw('(SELECT COUNT(id) FROM board_posts WHERE cat_id = board_cats.id) as catposts')
            ->orderBy('board_cats.order')
            ->get();

        return view('board.cats.create', [
            'cats' => $cats,
        ]);
    }

    public function order_cat($catid, $direction){
        if($direction == 'up'){
            \DB::table('board_cats')
                ->where('id', '=', $catid)
                ->increment('order');
        }else{
            \DB::table('board_cats')
                ->where('id', '=', $catid)
                ->decrement('order');
        }

        return redirect()->action('BoardController@create_cat');

    }

    public function store_cat(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
        ]);

        \DB::table('board_cats')->insert([
            'order' => 0,
            'title' => $request->get('name'),
            'desc' => $request->get('desc'),
            'created_at' => \Auth::id(),
        ]);

        return redirect()->action('BoardController@create_cat');
    }

    public function show_thread($threadid){

    }

    public function create_thread($catid){

    }

    public function store_thread($catid){

    }

    public function store_post($threadid){

    }
}
