<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Doctrine\DBAL\Driver\IBMDB2\DB2Connection;

class UserCreditsController extends Controller
{
    public function store(Request $request, $id){
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

    public function destroy($id, $credit_id){
        \DB::table('user_credits')
            ->where('game_id', '=', $id)
            ->where('id', '=', $credit_id)
            ->delete();

        return redirect()->action('GameController@edit', [$id]);
    }
}
