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
        </div>
    </div>
@endsection
