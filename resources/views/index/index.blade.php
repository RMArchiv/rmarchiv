@extends('layouts.app')
@section('pagetitle', 'home')
@section('content')
    <div id='content' class='frontpage'>
        <div id='leftbar' class='column'>
            @if(Auth::check() == true)
                @include('index._partials.logout')
            @else
                @include('index._partials.login')
            @endif
            @if(Auth::check() == true)
                @include('index._partials.pm')
            @endif
            @if($cdc)
                @include('index._partials.cdc')
            @endif
            @include('index._partials.latestadded')
            @include('index._partials.latestreleased')
            @include('index._partials.topmonth')
            @include('index._partials.topalltime')
        </div>
        <div id='middlebar' class='column'>
            @include('index._partials.shoutbox')
            @include('index._partials.board')
            @include('index._partials.news')
        </div>
        <div id='rightbar' class='column'>
            @include('index._partials.search')
            @include('index._partials.stats')
            @include('index._partials.topusers')
            @include('index._partials.latestcomments_game')
            @include('index._partials.nextparty')
            @include('index._partials.welike')
        </div>


    </div>
@endsection
