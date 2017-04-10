@extends('layouts.app')
@section('content')
    @if(Auth::check())
        @if(Auth::user()->id == $thread->user_id or Auth::user()->can('mod-threads'))
            <div class="rmarchivtbl">

            </div>
        @else
            <div id="content">
                <div class="rmarchivtbl">
                    Das darfst du nicht!
                </div>
            </div>
        @endif

    @else
        <div id="content">
            <div class="rmarchivtbl">
                Das darfst du nicht!
            </div>
        </div>
    @endif
@endsection