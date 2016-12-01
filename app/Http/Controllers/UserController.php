<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = User::orderBy('name')->paginate(15);

        return view('users.index', ['users' => $user]);
    }

    public function get(){

    }

    public function admin($userid){

        if(\Auth::check()){
            if(\Auth::user()->settings->is_admin == 1){
                $user = \DB::table('users as u')
                    ->leftJoin('user_settings as us', 'u.id', '=', 'us.user_id')
                    ->select([
                        'u.id as uid',
                        'u.name as uname',
                        'us.is_moderator as usmod',
                        'us.is_admin as usadmin',
                        'us.is_banned as usbanned'
                    ])
                    ->where('u.id', '=', $userid)
                    ->first();

                return view('users.admin', [
                    'user' => $user,
                ]);
            }
        }

    }

    public function admin_store(Request $request, $userid){

        $admin = ($request->get('admin') == "on") ? 1 : 0;
        $moderator = ($request->get('moderator') == "on") ? 1 : 0;
        $banned = ($request->get('banned') == "on") ? 1 : 0;

        \DB::table('user_settings')
            ->where('user_id', '=', $userid)
            ->update([
                'is_admin' => $admin,
                'is_moderator' => $moderator,
                'is_banned' => $banned,
            ]);

        return redirect()->action('UserController@admin', [$userid]);
    }
}
