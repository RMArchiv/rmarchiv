<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function create(){
        return view('users.lists.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required',
        ]);

        \DB::table('user_lists')->insert([
            'user_id' => \Auth::id(),
            'title' => $request->get('title'),
            'desc_md' => $request->get('desc'),
            'desc_html' => \Markdown::convertToHtml($request->get('desc')),
            'created_at' => Carbon::now()
        ]);

        return \Redirect::back();
    }

    public function add_game(Request $request, $listid, $gameid){
        if(\Auth::check()){
            $check = \DB::table('user_list_items')
                ->where('content_id', '=', $gameid)
                ->where('content_type', '=', 'game')
                ->where('list_id', '=', $listid)
                ->get();
            if($check->count() == 0){
                \DB::table('user_list_items')->insert([
                    'content_id' => $gameid,
                    'content_type' => 'game',
                    'user_id' => \Auth::id(),
                    'list_id' => $listid,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return \Redirect::action('GameController@show', $gameid);
    }

    public function show($listid){

    }

    public function index(){

    }
}
