@extends('layouts.app')
@section('pagetitle', $award->awardpage->title .': '. $award->title .' - '. $award->year . ' ' . trans('app.month.'. $award->month))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ $award->awardpage->title .': '. $award->title .' - '. $award->year . ' ' . trans('app.month.'. $award->month) }}
                        @if(Auth::check())
                            <div class="float-right">
                                <a href="{{ route('awards.create') }}" role="button" class="btn btn-primary"><span class="fa fa-plus"></span></a>
                            </div>
                        @endif
                    </h1>
                    {!! Breadcrumbs::render('awards.show', $award) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                @foreach($award->subcats as $s)
                    <div class="card">
                        <div class="card-header">
                            {{ $s->title }}
                        </div>
                        <ul class="list-group">
                            @foreach($s->game_awards as $a)
                                <li class="list-group-item media" style="margin-top: 0px;">
                                    <a class="float-right" href="{{ url('games', $a->game->id) }}"><span class="badge">{{ $a->game->comments }}</span></a>
                                    <div class="float-left">
                                        @php
                                            if ($a->place == 1) {
                                                $icon = 'medal_gold.png';
                                            } elseif ($a->place == 2) {
                                                $icon = 'medal_silver.png';
                                            } elseif ($a->place == 3) {
                                                $icon = 'medal_bronze.png';
                                            } else {
                                                $icon = 'no';
                                            }
                                        @endphp
                                        @if($icon != 'no')
                                            {{ trans('app.place') }} {{ $a->place }}
                                            <img src="/assets/{{ $icon }}" alt="{{ $a->place }}" title="{{ $a->place }}">
                                        @else
                                            {{ trans('app.place') }} {{ $a->place  }}
                                        @endif
                                    </div>
                                    <a class="float-left" href="{{ url('games', $a->game->id) }}">
                                        <img width="100px" class="img-responsive img-rounded" src='{{ route('screenshot.show', [$a->game->id, 1]) }}' alt='{{ trans('app.titlescreen') }}' title='{{ trans('app.titlescreen') }}'/>
                                    </a>
                                    <div class="thread-info">
                                        <div class="media-heading">
                                            @if($a->game->gamefiles->count() > 0)
                                                <span class='typeiconlist'>
                                                <span class='typei type_{{ $a->game->gamefiles->first()->gamefiletype->short }}'
                                                      title='{{ $a->game->gamefiles->first()->gamefiletype->title }}'>{{ $a->game->gamefiles->first()->gamefiletype->title }}</span>
                                            </span>
                                            @endif
                                            <span class="platformiconlist">
                                            <a href="{{ route('maker.show', $a->game->maker->id) }}">
                                                <span class="typei type_{{ $a->game->maker->short }}" title="{{ $a->game->maker->title }}">
                                                    {{ $a->game->maker->title }}
                                                </span>
                                            </a>
                                        </span>
                                            <a href='{{ url('games', $a->game->id) }}'>
                                                {{ $a->game->title }}
                                                @if($a->game->subtitle)
                                                    <small> - {{ $a->game->subtitle }}</small>
                                                @endif
                                                <span><img src="/assets/lng/16/{{ strtoupper($a->game->language->short) }}.png"
                                                           title="{{ $a->game->language->name }}"></span>
                                            </a>
                                            @if($a->game->cdcs->count() > 0)
                                                <div class="cdcstack">
                                                    <img src="/assets/cdc.png" title="{{ trans('app.coupdecoeur') }}" alt="{{ trans('app.coupdecoeur') }}">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="media-body" style="font-size: 12px;">
                                            {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($a->game->id) !!}<br>
                                            release date:
                                            @if(\Carbon\Carbon::parse($a->game->release_date)->year != -1 )
                                                {{ $a->game->release_date }}
                                            @else
                                                {{ \Carbon\Carbon::parse(\App\Helpers\DatabaseHelper::getReleaseDateFromGameId($a->game->id))->toDateString() }}
                                            @endif
                                            <span> • </span>
                                            hinzugefügt {{ \Carbon\Carbon::parse($a->game->created_at)->diffForHumans() }}
                                            <span> • </span>
                                            <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/> {{ $a->game->voteup or 0 }} -
                                            <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/> {{ $a->game->votedown or 0 }}
                                            <span> • </span>
                                            AVG: {{ number_format(floatval($a->game->avg), 2) }}&nbsp;
                                            @if($a->game->avg > 0)
                                                <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/>
                                            @elseif($a->game->avg == 0)
                                                <img src='/assets/rate_neut.gif' alt='{{ trans('app.rate_neut') }}'/>
                                            @elseif($a->game->avg < 0)
                                                <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/>
                                            @endif
                                            <div class="pull-right">
                                                @foreach($a->game->tags as $tag)
                                                    <a href="{{ action('TaggingController@showGames', [$tag->tag_id]) }}"><span class="label label-primary">{{ $tag->tag->title }}</span></a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection