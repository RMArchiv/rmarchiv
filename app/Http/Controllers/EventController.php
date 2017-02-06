<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class EventController extends Controller
{
    //-------------------------------------------------
    // Events
    public function index() {
        $events = Event::orderBy('start_date', 'desc')->get();

        return view('events.index', [
            'events' => $events,
        ]);
    }

    public function show($id) {
        $event = Event::whereId($id)->first();

        return view('events.show', [
            'event' => $event,
        ]);
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        dd($request);
        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'slots' => 'required|numeric',
            'reg_start_date' => 'date',
            'reg_end_date' => 'date'
        ]);

        $e = new Event;
        $e->title = $request->get('title');
        $e->description = $request->get('desc');
        $e->start_date = $request->get('start');
        $e->end_date = $request->get('end');
        $e->user_id = \Auth::id();
        $e->save();

        $es = new EventSetting;
        $es->event_id = $e->id;
        $es->slots = $request->get('slots');
        $es->reg_price = $request->get('price');
        $es->reg_start_date = $request->get('reg_start');
        $es->reg_end_date = $request->get('reg_end');
        if ($request->get('reg_allowed') == "on") {
            $es->reg_allowed = 1;
        }else {
            $es->reg_allowed = 0;
        }
        $es->save();

        return redirect()->action('EventController@show', [$e->id]);
    }

    public function edit($id) {
        $event = Event::whereId($id)->first();

        return view('events.edit', [
            'event' => $event,
        ]);
    }

    public function update($id) {
        $e = Event::whereId($id)->first();
        $e->title = Input::get('title');
        $e->description = Input::get('desc');
        $e->start_date = Input::get('start');
        $e->end_date = Input::get('end');
        $e->settings->slots = Input::get('slots');
        $e->settings->reg_price = Input::get('price');
        $e->settings->reg_start_date = Input::get('reg_start');
        $e->settings->reg_end_date = Input::get('reg_end');
        $e->settings->reg_allowed = Input::get('reg_allowed');
        $e->save();

        return redirect()->action('EventController@show', $e->id);
    }

    //-------------------------------------------------
    // Meetings
    public function meeting_index($eventid) {

    }

    public function meeting_show($id) {

    }

    public function meeting_create() {

    }

    public function meeting_store() {

    }

    public function meeting_edit($id) {

    }

    public function meeting_update($id) {

    }

    //-------------------------------------------------
    // Pictures
    public function picture_index() {

    }

    public function picture_show($id) {

    }

    public function picture_create() {

    }

    public function picture_store() {

    }

    public function picture_edit($id) {

    }

    public function picture_update($id) {

    }
}
