<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserCreditsController.
 */
class UserCreditsController extends Controller
{
    /**
     * Store usercredits to the database.
     *
     * @param Request $request
     * @param $id - game_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        if (\Auth::check()) {
            $this->validate($request, [
                'user'   => 'required',
                'credit' => 'required|not_in:0',
            ]);

            //Get UserID from Username
            $userid = User::whereName($request->get('user'))->first();

            //Check for existing of selected user
            if ($userid) {
                //store new usercredit to database
                \DB::table('user_credits')->insert([
                    'user_id'        => $userid->id,
                    'game_id'        => $id,
                    'credit_type_id' => $request->get('credit'),
                    'created_at'     => Carbon::now(),
                ]);
            }
        }

        return redirect()->action('GameController@edit', [$id]);
    }

    /**
     * Deletes user credit in database.
     *
     * @param $id
     * @param $credit_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, $credit_id)
    {
        if (\Auth::check()) {
            //Delete usercredit from database
            \DB::table('user_credits')
                ->where('game_id', '=', $id)
                ->where('id', '=', $credit_id)
                ->delete();
        }

        return redirect()->action('GameController@edit', [$id]);
    }
}
