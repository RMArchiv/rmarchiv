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

    }

    public function unban(Request $request, $userid){
        $user = User::whereId($userid)->first();

        $user->unban();

        return redirect(action('UserBanController@show', $userid));
    }
}
