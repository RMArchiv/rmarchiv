@extends('layouts.app')
@section('pagetitle', 'shoutbox historie')
@section('content')
    <div id="content">
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <h2>aktivitätshistorie</h2>
            <ul class="boxlist">
                @foreach($obyx as $o)
                    <li><a href='{{ url('users', $o->user->id) }}' class='usera' title="{{ $o->user->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $o->user->id }}' alt="{{ $o->user->name }}" class='avatar'/> {{ $o->user->name }}</a> :: <time datetime='{{ $o->created_at }}' title='{{ $o->created_at }}'>{{ \Carbon\Carbon::parse($o->created_at)->diffForHumans() }}</time>
                        <br>{!! $o->obyx->value !!} obyx für: {{ $o->obyx->reason_visible }}
                    </li>
                @endforeach
                {{ $obyx->links('vendor.pagination.shoutbox') }}
            </ul>
        </div>
    </div>
@endsection