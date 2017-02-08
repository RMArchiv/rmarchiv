<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Events\TelegramNotification;
use App\Helpers\MiscHelper;
use Carbon\Carbon;
use App\Events\Obyx;
use App\Models\Shoutbox;
use Illuminate\Http\Request;

class ShoutboxController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'shout' => 'required',
        ]);

        \DB::table('shoutbox')
            ->insert([
                'shout_md'   => $request->get('shout'),
                'shout_html' => \Markdown::convertToHtml($request->get('shout')),
                'user_id'    => \Auth::id(),
                'created_at' => Carbon::now(),
            ]);


        MiscHelper::sendTelegram('Shoutbox von ['.\Auth::user()->name.'](http://rmarchiv.de/users/'.\Auth::user()->id.')'.PHP_EOL.'*Nachricht:* '.$request->get('shout'));
        event(new Obyx('shoutbox', \Auth::id()));


        return redirect()->route('home');
    }

    public function index()
    {
        $shoutbox = Shoutbox::with('user')->orderBy('created_at', 'desc')->paginate(25);

        return view('shoutbox.index', [
            'shoutbox' => $shoutbox,
        ]);
    }
}
