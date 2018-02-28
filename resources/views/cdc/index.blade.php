@extends('layouts.app')
@section('pagetitle', 'Coup de Coeur Historie')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>Coup de Coeur Historie</h1>
                    {!! Breadcrumbs::render('cdc.index') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Coup de Coeur Historie
                    </div>
                    <ul class="list-group">
                        @foreach($cdcs as $c)
                            <li class="list-group-item media" style="margin-top: 0px;">
                                <a class="pull-right" href="{{ url('games', $c->game->id) }}"><span
                                            class="badge">{{ $c->game->comments }}</span></a>
                                <a class="pull-left" href="{{ url('games', $c->game->id) }}"><img width="100px"
                                                                                               class="mr-3"
                                                                                               src='{{ route('screenshot.show', [$c->game->id, 1]) }}'
                                                                                               alt='{{ trans('app.titlescreen') }}'
                                                                                               title='{{ trans('app.titlescreen') }}'/></a>
                                <div class="thread-info">
                                    <div class="media-heading">
                                        @if($c->game->gamefiles->count() > 0)
                                            <span class='typeiconlist'>
                                                <span class='typei type_{{ $c->game->gamefiles->first()->gamefiletype->short }}'
                                                      title='{{ $c->game->gamefiles->first()->gamefiletype->title }}'>{{ $c->game->gamefiles->first()->gamefiletype->title }}</span>
                                            </span>
                                        @endif
                                         <span class="platformiconlist">
                                            <a href="{{ route('maker.show', $c->game->maker->id) }}">
                                                <span class="typei type_{{ $c->game->maker->short }}" title="{{ $c->game->maker->title }}">
                                                    {{ $c->game->maker->title }}
                                                </span>
                                            </a>
                                        </span>
                                        <a href='{{ url('games', $c->game->id) }}'>
                                            {{ $c->game->title }}
                                            @if($c->game->subtitle)
                                                <small> - {{ $c->game->subtitle }}</small>
                                            @endif
                                            <span><img src="/assets/lng/16/{{ strtoupper($c->game->language->short) }}.png"
                                                       title="{{ $c->game->language->name }}"></span>
                                        </a>
                                        @if($c->game->cdcs->count() > 0)
                                            <div class="cdcstack">
                                                <img src="/assets/cdc.png" title="{{ trans('app.coupdecoeur') }}"
                                                     alt="{{ trans('app.coupdecoeur') }}">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="media-body" style="font-size: 12px;">
                                        {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($c->game->id) !!}<br>
                                        release date:
                                        @if(\Carbon\Carbon::parse($c->game->release_date)->year != -1 )
                                            {{ $c->game->release_date }}
                                        @else
                                            {{ \Carbon\Carbon::parse(\App\Helpers\DatabaseHelper::getReleaseDateFromGameId($c->game->id))->toDateString() }}
                                        @endif
                                        <span> • </span>
                                        hinzugefügt {{ \Carbon\Carbon::parse($c->game->created_at)->diffForHumans() }}
                                        <span> • </span>
                                        <img src='/assets/rate_up.gif'
                                             alt='{{ trans('app.rate_up') }}'/> {{ $c->game->voteup or 0 }} -
                                        <img src='/assets/rate_down.gif'
                                             alt='{{ trans('app.rate_down') }}'/> {{ $c->game->votedown or 0 }}
                                        <span> • </span>
                                        AVG: {{ number_format(floatval($c->game->avg), 2) }}&nbsp;
                                        @if($c->game->avg > 0)
                                            <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/>
                                        @elseif($c->game->avg == 0)
                                            <img src='/assets/rate_neut.gif' alt='{{ trans('app.rate_neut') }}'/>
                                        @elseif($c->game->avg < 0)
                                            <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/>
                                        @endif
                                        <div class="pull-right">
                                            @foreach($c->game->tags as $tag)
                                                <a href="{{ action('TaggingController@showGames', [$tag->tag_id]) }}"><span
                                                            class="badge badge-pill">{{ $tag->tag->title }}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection