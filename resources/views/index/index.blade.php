@extends('layouts.app')
@section('pagetitle', trans('app.home'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @if($cdc)
                    @if($widgets['cdc'])
                        @include('index._partials.cdc')
                    @endif
                @endif

                @if($widgets['latestadded'])
                    @include('index._partials.latestadded')
                @endif

                @if($widgets['latestreleased'])
                    @include('index._partials.latestreleased')
                @endif

                @if($widgets['topmonth'])
                    @include('index._partials.topmonth')
                @endif

                @if($widgets['topalltime'])
                    @include('index._partials.topalltime')
                @endif
            </div>
            <div class="col-md-6">
                @if($widgets['shoutbox'])
                    @include('index._partials.shoutbox')
                @endif

                @if($widgets['board'])
                    @include('index._partials.board')
                @endif

                @if($widgets['news'])
                    @include('index._partials.news')
                @endif
            </div>
            <div class="col-md-3">
                @include('index._partials.randomgame')
                @include('index._partials.partner')

                @if($widgets['tags'])
                    @include('index._partials.tagcloud')
                @endif

                @if($widgets['stats'])
                    @include('index._partials.stats')
                @endif

                @if($widgets['obyx'])
                    @include('index._partials.topusers')
                @endif

                @if($widgets['comments'])
                    {{-- @include('index._partials.latestcomments_game') --}}
                @endif

                @include('index._partials.nextparty')
                @include('index._partials.welike')

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <iframe src="https://discordapp.com/widget?id=269382903450959872&theme=dark" width="100%" height="500" allowtransparency="true" frameborder="0" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
