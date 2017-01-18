@extends('layouts.app')
@section('pagetitle', 'shoutbox historie')
@section('content')
    <div id="content">
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <h2>die komplette shoutbox historie</h2>
            <ul class="boxlist">
                @foreach($shoutbox as $shout)
                <li><a href='{{ url('users', $shout->user->id) }}' class='usera' title="{{ $shout->user->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $shout->user->id }}' alt="{{ $shout->user->name }}" class='avatar'/> {{ $shout->user->name }}</a> :: <time datetime='{{ $shout->created_at }}' title='{{ $shout->created_at }}'>{{ $shout->created_at }}</time>
                    {!! $shout->shout_html !!}
                </li>
                @endforeach
                {{ $shoutbox->links('vendor.pagination.shoutbox') }}
            </ul>
        </div>
    </div>
@endsection