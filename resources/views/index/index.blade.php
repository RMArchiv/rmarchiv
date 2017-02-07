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

            @if(!Auth::check() || Auth::user()->settings->disable_widget_msg != 1)
                @if(Auth::check() == true)
                    @include('index._partials.pm')
                @endif
            @endif

            @if($cdc)
                @if(!Auth::check() || Auth::user()->settings->disable_widget_cdc != 1)
                    @include('index._partials.cdc')
                @endif
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_gamesadded != 1)
                @include('index._partials.latestadded')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_gamesreleased != 1)
                @include('index._partials.latestreleased')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_topmonth != 1)
                @include('index._partials.topmonth')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_alltimetop != 1)
                @include('index._partials.topalltime')
            @endif
        </div>
        <div id='middlebar' class='column'>
            @if(!Auth::check() || Auth::user()->settings->disable_widget_shoutbox != 1)
                @include('index._partials.shoutbox')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_board != 1)
                @include('index._partials.board')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_news != 1)
                @include('index._partials.news')
            @endif
        </div>
        <div id='rightbar' class='column'>
            @if(!Auth::check() || Auth::user()->settings->disable_widget_search != 1)
                @include('index._partials.search')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_tags != 1)
                @include('index._partials.tagcloud')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_stats != 1)
                @include('index._partials.stats')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_obyx != 1)
                @include('index._partials.topusers')
            @endif

            @if(!Auth::check() || Auth::user()->settings->disable_widget_comments != 1)
                @include('index._partials.latestcomments_game')
            @endif

            @include('index._partials.nextparty')
            @include('index._partials.welike')
        </div>


    </div>
@endsection
