<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\User;
use Cog\Contracts\Ban\Bannable;
use Illuminate\Http\Request;

class UserBanController extends Controller
{
    public function show($userid){
        $user = User::whereId($userid)->first();

        return view('users.ban.show', [
            'user' => $user,
        ]);
    }

    public function ban(Request $request ,$userid){
        $user = User::whereId($userid)->first();

        $exp = 0;

        if($request->exists('forever')){
            $exp = '+ 150 years';
        }elseif($request->exists('aday')){
            $exp = '+1 day';
        }elseif($request->exists('aweek')){
            $exp = '+1 week';
        }elseif($request->exists('amonth')){
            $exp = '+1 month';
        }

        $user->ban([
            'comment' => $request->get('banreason'),
            'expired_at' => $exp,
        ]);

        return redirect(action('UserBanController@show', $userid));
    }

    public function unban(Request $request, $userid){
        $user = User::whereId($userid)->first();

        $user->unban();

        return redirect(action('UserBanController@show', $userid));
    }
}
