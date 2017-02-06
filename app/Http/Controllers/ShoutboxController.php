<?php

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\Shoutbox;
use Carbon\Carbon;
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
