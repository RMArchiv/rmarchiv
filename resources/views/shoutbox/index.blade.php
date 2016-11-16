@extends('layouts.app')
@section('content')
    <div id="content">
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <h2>die komplette shoutbox historie</h2>
            <ul class="boxlist">
                @foreach($shoutbox as $shout)
                <li><a href='{{ url('users', $shout->userid) }}' class='usera' title="{{ $shout->username }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $shout->userid }}' alt="{{ $shout->username }}" class='avatar'/> {{ $shout->username }}</a> :: <time datetime='{{ $shout->shoutcreated_at }}' title='{{ $shout->shoutcreated_at }}'>{{ $shout->shoutcreated_at }}</time>
                    {!! $shout->shouthtml !!}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection