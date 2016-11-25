@extends('layouts.app')

@section('content')
    <div id='content' class='frontpage'>
        <div id='leftbar' class='column'>
            @if(Auth::check() == true)
                @include('index._partials.logout')
            @else
                @include('index._partials.login')
            @endif
            @if($cdc)
                @include('index._partials.cdc')
            @endif
            {% include 'index/_partial/latestadded.twig' %}
            {% include 'index/_partial/latestreleased.twig' %}
            {% include 'index/_partial/topmonth.twig' %}
            {% include 'index/_partial/topalltime.twig' %}
        </div>
        <div id='middlebar' class='column'>
            @include('index._partials.shoutbox')
            {% include 'index/_partial/board_latest.twig' %}
            @include('index._partials.news')
        </div>
        <div id='rightbar' class='column'>
            {% include 'index/_partial/searchbox.twig' %}
            {% include 'index/_partial/stats.twig' %}
            {% include 'index/_partial/welike.twig' %}
            {% include 'index/_partial/latestcomments.twig' %}
            {% include 'index/_partial/upcomingparties.twig' %}
            {% include 'index/_partial/wanted.twig' %}
            {% include 'index/_partial/topusers.twig' %}
        </div>
    </div>
@endsection
