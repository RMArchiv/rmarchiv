<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventSetting;
use App\Models\EventUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class EventController extends Controller
{
    //-------------------------------------------------
    // Events
    public function index()
    {
        $events = Event::orderBy('start_date', 'desc')->get();

        return view('events.index', [
            'events' => $events,
        ]);
    }

    public function show($id)
    {
        $event = Event::whereId($id)->first();
        $reg = EventUserRegistered::whereEventId($id)->where('user_id', '=', \Auth::id())->get();

        return view('events.show', [
            'event' => $event,
            'reg_user' => $reg,
        ]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'          => 'required',
            'desc'           => 'required',
            'start'          => 'required|date',
            'end'            => 'required|date',
            'slots'          => 'required|numeric',
            'reg_start_date' => 'date',
            'reg_end_date'   => 'date',
            'price' => 'numeric',
        ]);

        $e = new Event();
        $e->title = $request->get('title');
        $e->description = $request->get('desc');
        $e->start_date = $request->get('start');
        $e->end_date = $request->get('end');
        $e->user_id = \Auth::id();
        $e->save();

        $es = new EventSetting();
        $es->event_id = $e->id;
        $es->slots = $request->get('slots');
        $es->reg_price = $request->get('price');
        $es->reg_start_date = $request->get('reg_start');
        $es->reg_end_date = $request->get('reg_end');
        if ($request->get('reg_allowed') == 'on') {
            $es->reg_allowed = 1;
        } else {
            $es->reg_allowed = 0;
        }
        $es->save();

        return redirect()->action('EventController@show', [$e->id]);
    }

    public function edit($id)
    {
        $event = Event::whereId($id)->first();

        return view('events.edit', [
            'event' => $event,
        ]);
    }

    public function update($id)
    {
        $e = Event::whereId($id)->first();
        $e->title = Input::get('title');
        $e->description = Input::get('desc');
        $e->start_date = Input::get('start');
        $e->end_date = Input::get('end');

        $settings = EventSetting::whereEventId($id)->first();
        $settings->slots = Input::get('slots');
        $settings->reg_price = Input::get('price');
        $settings->reg_start_date = Input::get('reg_start');
        $settings->reg_end_date = Input::get('reg_end');
        $settings->reg_allowed = Input::get('reg_allowed');
        if (Input::get('reg_allowed') == 'on') {
            $settings->reg_allowed = 1;
        } else {
            $settings->reg_allowed = 0;
        }
        $settings->save();

        return redirect()->action('EventController@show', $e->id);
    }

    public function register($eventid)
    {
        $event = Event::whereId($eventid)->first();
        $reg = EventUserRegistered::whereEventId($eventid)->where('user_id', '=', \Auth::id())->get();

        return view('events.register', [
            'event' => $event,
            'reg_user' => $reg,
        ]);
    }

    public function register_store(Request $request, $eventid)
    {
        $event = Event::whereId($eventid)->first();

        if($event->settings->reg_allowed == 1 && $event->settings->slots > $event->users_registered->count())
        {
            if(EventUserRegistered::whereEventId($eventid)->where('user_id', '=', \Auth::id())->count() == 0){
                EventUserRegistered::firstOrNew([
                    'event_id' => $eventid,
                    'user_id' => \Auth::id(),
                    'reg_price_payed' => 0,
                    'reg_state' => 0,
                ])->save();
            }
        }

        return redirect()->action('EventController@show', $eventid);
    }

    //-------------------------------------------------
    // Meetings
    public function meeting_index($eventid)
    {
    }

    public function meeting_show($id)
    {
    }

    public function meeting_create()
    {
    }

    public function meeting_store()
    {
    }

    public function meeting_edit($id)
    {
    }

    public function meeting_update($id)
    {
    }

    //-------------------------------------------------
    // Pictures
    public function picture_index()
    {
    }

    public function picture_show($id)
    {
    }

    public function picture_create()
    {
    }

    public function picture_store()
    {
    }

    public function picture_edit($id)
    {
    }

    public function picture_update($id)
    {
    }
}
