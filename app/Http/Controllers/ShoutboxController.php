<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ShoutboxController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'shout' => 'required',
        ]);

        \DB::table('shoutbox')
            ->insert([
                'shout_md' => $request->get('shout'),
                'shout_html' => \Markdown::convertToHtml($request->get('shout')),
                'user_id' => \Auth::id(),
                'created_at' => Carbon::now()
            ]);

        return redirect()->route('home');
    }
}
