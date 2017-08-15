@extends('layouts.app')
@section('pagetitle', trans('app.user_activities'))
@section('content')
    <div id="content">
        <div class="rmarchivtbl" id="rmarchivbox_onelinerview">
            <h2>{{ trans('app.user_activities') }}</h2>
            <ul class="boxlist">
                @foreach($obyx as $o)
                    <li><a href='{{ url('users', $o->user->id) }}' class='usera' title="{{ $o->user->name }}"><img src='//{{ config('app.avatar_path') }}?gender=male&id={{ $o->user->id }}' alt="{{ $o->user->name }}" class='avatar'/> {{ $o->user->name }}</a> :: <time datetime='{{ $o->created_at }}' title='{{ $o->created_at }}'>{{ \Carbon\Carbon::parse($o->created_at)->diffForHumans() }}</time>
                        <br>{!! $o->obyx->value !!} {{ trans('app.obyx_for') }}: {{ $o->obyx->reason_visible }}
                    </li>
                @endforeach
                {{ $obyx->links('vendor.pagination.shoutbox') }}
            </ul>
        </div>
    </div>
@endsection