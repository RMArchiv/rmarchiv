<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class UserCreditsController extends Controller
{
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'user' => 'required',
            'credit' => 'required|not_in:0',
        ]);

        $userid = User::whereName($request->get('user'))->first()->id;

        \DB::table('user_credits')->insert([
            'user_id' => $userid,
            'game_id' => $id,
            'credit_type_id' => $request->get('credit'),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->action('GameController@edit', [$id]);
    }

    public function destroy($id, $credit_id)
    {
        \DB::table('user_credits')
            ->where('game_id', '=', $id)
            ->where('id', '=', $credit_id)
            ->delete();

        return redirect()->action('GameController@edit', [$id]);
    }
}
