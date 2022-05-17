@extends('layouts.app')
@section('pagetitle', $game->title.' - '.$game->subtitle)
@section('content')
    @if($game)
        <script>
            $(document).ready(function () {
                $('[data-toggle="userlist"]').popover({
                    html: true,
                    container: 'body'
                });
            });
        </script>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        @if(Auth::check())
                            <div class='btn-toolbar pull-right'>
                                <div class='btn-group'>
                                    @if(Auth::check())
                                        @if(Auth::user()->userlists)
                                            @php
                                                $ul_data = "<a href='". url('lists/create') ."'>".trans('app.create_userlist') ."</a><br>";
                                                foreach (Auth::user()->userlists as $list){
                                                    $ul_data .= "<a href='". route('lists.add_game', [$list->id, $game->id]). "'>".$list->title."</a><br>";
                                                }
                                            @endphp
                                        @endif
                                        <a role="button" class="btn btn-primary"
                                           data-toggle="userlist"
                                           title="benutzerliste"
                                           data-content="{!! $ul_data !!}">
                                            <span class="fa fa-list"></span></a>
                                        @permission(('create-games'))
                                        <a href="{{ route('history.game.index', ['id' => $game->id]) }}" role='button' class='btn btn-primary'><span class="fa fa-history"></span></a>
                                        <a href="{{ action('GameController@edit', [ 'id' => $game->id]) }}" role="button" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                        @endpermission
                                    @endif

                                </div>
                            </div>
                        @endif
                        <h1>
                            <span id='title'><big>{{ $game->title }}</big>@if($game->subtitle) :: {{ $game->subtitle }}@endif</span>
                        </h1>
                        {!! Breadcrumbs::render('game', $game) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row mt-4">
                        <div class='col-md-6'>
                            {{-- screenshots --}}
                            @if(\App\Models\GamesFile::whereGameId($game->id)->where("forbidden", '=', 1)->get()->count() != 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-white bg-danger">
                                        <div class="card-header">Gesperrte Downloads</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Dieses Spiel enthält gesperrte Downloads</h5>
                                            <p class="card-text">
                                                Mindestens eine Datei in diesem Spiel wurde gemeldet und ensprechend gesperrt.

                                                Für weitere Informationen zu diesen Dateien bitte hier klicken:
                                                <a href="{{ action('GameFileController@create', $game->id) }}"> Dateiliste</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <ul class="nav nav-pills nav-fill">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="pill" href="#tabs-1">{{ trans('app.titlescreen') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tabs-2">{{ trans('app.screenshot') }} 1</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tabs-3">{{ trans('app.screenshot') }} 2</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tabs-4">{{ trans('app.screenshot') }} 3</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tabs-5">{{ trans('app.screenshot') }} 4</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tabs-6">{{ trans('app.screenshot') }} 5</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tabs-7">{{ trans('app.screenshot') }} 6</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tabs-8">{{ trans('app.screenshot') }} 7</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tabs-9">{{ trans('app.screenshot') }} 8</a>
                                                </li>
                                                @if($game->youtube)
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#tabs-10">{{ trans('app.trailer') }}</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div id="tabs-1" class="tab-pane fade show active">
                                                <div class="card-body">
                                                    <img class="img-fluid center-block" src='{{ route('screenshot.show', [$game->id, 1]) }}' alt='{{ trans('app.titlescreen') }}' title='{{ trans('app.titlescreen') }}'/>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="{{ route('screenshot.show', [$game->id, 1, 1]) }}">{{ trans('app.show_original_size') }}</a>
                                                    @if(Auth::check())
                                                        ::
                                                        <a href="{{ route('screenshot.create', [$game->id, 1]) }}">{{ trans('app.upload_titlescreen') }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                            @for($i = 2; $i <=9; $i++)
                                                <div id="tabs-{{ $i }}" class="tab-pane fade">
                                                    <div class="card-body">
                                                        <img class="img-fluid center-block" src='{{ route('screenshot.show', [$game->id, $i]) }}'
                                                             alt='{{ trans('app.screenshot') }}' title='{{ trans('app.screenshot') }}'/>
                                                    </div>
                                                    <div class="card-footer">
                                                        <a href="{{ route('screenshot.show', [$game->id, $i, 1]) }}">{{ trans('app.show_original_size') }}</a>
                                                        @if(Auth::check())
                                                            ::
                                                            <a href="{{ route('screenshot.create', [$game->id, $i]) }}">{{ trans('app.upload_titlescreen') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endfor
                                            @if($game->youtube)
                                                @php
                                                    $vid = str_replace('watch?v=', "embed/", $game->youtube);
                                                @endphp
                                                <div id="tabs-10" class="tab-pane fade">
                                                    <div class="card-body">
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item" src="{{ $vid }}" frameborder="0" allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        {{ trans('app.editable_with_edit_button') }}
                                                    </div>
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- infos & stats --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('app.informations') }}
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                {{ trans('app.maker') }} :
                                                <a href="{{ route('maker.show', $game->maker->id) }}">
                                                    <span class="typei type_{{ $game->maker->short }}">{{ $game->maker->title }}</span> {{ $game->maker->title }}
                                                </a>
                                                </td>
                                            </li>
                                            <li class="list-group-item">
                                                {{ trans('app.gametype') }} :
                                                @if(count($game->gamefiles) > 0)
                                                    <span class='typei type_{{ $game->gamefiles->first()->gamefiletype->short }}'>{{ $game->gamefiles->first()->gamefiletype->title }}</span> {{ $game->gamefiles->first()->gamefiletype->title }}
                                                @else
                                                    {{ trans('app.no_gamefile_available') }}
                                                @endif
                                            </li>
                                            <li class="list-group-item">
                                                {{ trans('app.developers') }} :
                                                @foreach($game->developers as $dev)
                                                    <a href="{{ url('developer',$dev->developer_id) }}">{{ $dev->developer->name }}</a>
                                                    @if($dev != $game->developers->last())
                                                        ::
                                                    @endif
                                                @endforeach
                                            </li>
                                            <li class="list-group-item">
                                                {{ trans('app.release_date') }} : {{ \App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id) }}
                                            </li>
                                            @if($game->website_url)
                                                <li class="list-group-item">{{ trans('app.website') }} :
                                                    <a href="{{ $game->website_url }}" target="_blank">{{ trans('app.click_me') }}</a>
                                                </li>
                                            @endif
                                            @if($game->atelier_id)
                                                <li class="list-group-item">
                                                    {{ trans('app.atelier_link') }} :
                                                    <a href="http://www.rpg-atelier.net/index.php?site=showgame&gid={{ $game->atelier_id }}" target="_blank">{{ trans('app.click_me') }}</a>
                                                </li>
                                            @endif
                                            <li class="list-group-item">
                                                {{ trans('app.submitted_by') }}: <a
                                                        href='{{ url('users', $game->user_id) }}' class='user'>{{ $game->user->name }}</a>
                                                <a href='{{ url('users', $game->user_id) }}' class='usera' title="{{ $game->user->name }}">
                                                    <img width="16px" src='//{{ config('app.avatar_path') }}?gender=male&id={{ $game->user_id }}'
                                                         alt="{{ $game->user->name }}" class='avatar'/>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                {{ trans('app.submitted_at') }}
                                                <time datetime='{{ $game->created_at }}' title='{{ $game->created_at }}'>{{ \Carbon\Carbon::parse($game->created_at)->diffForHumans() }}</time>
                                            </li>
                                            @if($game->license)
                                                <li class="list-group-item">
                                                    {{ trans('app.license') }}
                                                    {{ $game->license->title }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('app.misc') }}
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                @php
                                                    $perc = \App\Helpers\MiscHelper::getPopularity($game->views, \App\Helpers\DatabaseHelper::getGameViewsMax());
                                                @endphp
                                                {{ trans('app.popularity') }}: {{  number_format($perc, 2) }}%
                                                <br/>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: {{  number_format($perc, 2) }}%;"></div>
                                                </div>
                                            </li>
                                            <li class="list-group-item clearfix">
                                                <ul class="col-md-6 list-unstyled">
                                                    <li>votes:</li>
                                                    <li>
                                                        <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/>&nbsp;{{ $game->votes['up'] or 0 }}
                                                    </li>
                                                    <li>
                                                        <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/>&nbsp;{{ $game->votes['down'] or 0 }}
                                                    </li>
                                                </ul>
                                                <ul class="col-md-6 list-unstyled">
                                                    <li>avg:</li>
                                                    @if($game->votes['up'] > $game->votes['down'])
                                                        <li>
                                                            <img src='/assets/rate_up.gif' alt='ok'/>&nbsp;{{ $game->votes['avg'] or 0 }}
                                                        </li>
                                                    @elseif($game->votes['up'] < $game->votes['down'])
                                                        <li>
                                                            <img src='/assets/rate_down.gif' alt='ok'/>&nbsp;{{ $game->votes['avg'] or 0 }}
                                                        </li>
                                                    @elseif($game->votes['up'] == $game->votes['down'])
                                                        <li>
                                                            <img src='/assets/rate_neut.gif' alt='ok'/>&nbsp;{{ $game->votes['avg'] or 0 }}
                                                        </li>
                                                    @else
                                                        <li>
                                                            <img src='/assets/rate_neut.gif' alt='ok'/>&nbsp;{{ $game->votes['avg'] or 0 }}
                                                        </li>
                                                    @endif
                                                    {{-- data.cdc > 0
                                                <li><img src="/assets/cdc.png" alt="cdcs">cdc's</li>
                                                 endif
                                                 --}}
                                                    <li>{{ trans('app.alltime_top') }}: #0</li>
                                                </ul>
                                            </li>
                                            @if(Auth::check())
                                                @if($game->gamefiles->count() != 0)
                                                    @if($game->maker_id == 2 or $game->maker_id == 3 or $game->maker_id == 6 or $game->maker_id == 9)
                                                        <li class="list-group-item">
                                                            {{ trans('app.play_in_browser') }} :
                                                            <a href=
                                                            @if($game->maker_id == 6)
                                                                "{{ action('PlayerMvController@index', $game->gamefiles->first()->id) }}"
                                                            @else
                                                                "{{ action('Player2kController@index', $game->gamefiles->first()->id) }}"
                                                            @endif
                                                            ><img src="/assets/play_button.png" alt="play"></a>
                                                        </li>
                                                    @endif
                                                @endif
                                            @endif
                                            <li class="list-group-item">
                                                <a href="{{ action('ReportController@create_game_report', $game->id) }}">{{ trans('app.report_game') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class='col-md-6'>
                            {{-- spielbeschreibung --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">{{ trans('app.description') }}</div>
                                        <div class="card-body readmore">
                                            {!! Markdown::convertToHtml($game->desc_md) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- tags & downloads --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('app.tags') }}
                                        </div>
                                        <div class="card-body">
                                            @if(Auth::check())
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addtag">{{ trans('app.add_tag') }}</button>
                                                <div id="addtag" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title">{{ trans('app.add_tag') }}</h4>
                                                            </div>
                                                            <div class="modal-body clearfix">
                                                                <div class="col-md-12">
                                                                    {!! Form::open(['action' => ['TaggingController@store'], 'class' => 'form-horizontal']) !!}
                                                                    {!! Form::hidden('content_id', $game->id) !!}
                                                                    {!! Form::hidden('content_type', 'game') !!}
                                                                    <fieldset>
                                                                        <div class="form-group">
                                                                            <label for="title" class="col-form-label">{{ trans('app.tag_name') }}</label>
                                                                            <input type="text" class="form-control" name="title" id="title" placeholder="" value=""/>
                                                                        </div>
                                                                        <div class='form-group'>
                                                                            <input class="btn btn-primary" type='submit' value='{{ trans('app.submit') }}' id='submit'>
                                                                        </div>
                                                                    </fieldset>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <br>
                                            @foreach($game->tags as $tag)
                                                <a href="{{ action('TaggingController@showGames', [$tag->tag_id]) }}">{{ $tag->tag->title }}</a>
                                                @if($tag != $game->tags->last())
                                                    ::
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('app.downloads') }}
                                        </div>
                                        <ul class="list-group">
                                            @foreach($game->gamefiles as $f)
                                                <li class="list-group-item">
                                                        {{ str_pad($f->release_year, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_month, 2, 0, STR_PAD_LEFT) }}-{{ str_pad($f->release_day, 2, 0, STR_PAD_LEFT) }}
                                                        [
                                                        @if($f->language)
                                                            <span><img src="/assets/lng/16/{{ strtoupper($f->language->short) }}.png" title="{{ $f->language->name }}"></span>
                                                        @endif
                                                        @if($f->forbidden == 0)
                                                        <a href="{{ url('games/download', [$f->id, time()]) }}" class="down_l">
                                                            {{ $f->gamefiletype->title }} - {{ $f->release_version }}
                                                        </a>
                                                        @else
                                                            {{ $f->gamefiletype->title }} - {{ $f->release_version }}
                                                        @endif
                                                        ]
                                                        <span class="badge">{{ $f->downloadcount }}</span>
                                                </li>
                                            @endforeach
                                            <li class="list-group-item">------------</li>
                                            <li class="list-group-item">
                                                <a href="{{ action('GameFileController@create', $game->id) }}">{{ trans('app.gamefile_list_and_add') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            {{-- credits --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">{{ trans('app.user_credits') }}</div>
                                        <ul class="list-group">
                                            @if($game->credits->count() != 0)
                                                @foreach($game->credits as $cr)
                                                    <li class="list-group-item">
                                                        <a href='{{ url('users', $cr->user_id) }}' class='usera' title="{{ $cr->user->name }}"><img width="16px" src='//{{ config('app.avatar_path') }}?gender=male&id={{ $cr->user_id }}' alt="{{ $cr->user->name }}" class='avatar'/>
                                                        </a>
                                                        <a href='{{ url('users', $cr->user_id) }}' class='user'>{{ $cr->user->name }}</a> [{{ $cr->type->title }}]
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item">{{ trans('app.no_user_credits_added') }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- award spalte --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">{{ trans('app.awards') }}</div>
                                        <ul class="list-group">
                                            @if($game->awards)
                                                @foreach($game->awards as $aw)
                                                    <?php
                                                    if ($aw->place == 1) {
                                                        $icon = 'medal_gold.png';
                                                    } elseif ($aw->place == 2) {
                                                        $icon = 'medal_silver.png';
                                                    } elseif ($aw->place == 3) {
                                                        $icon = 'medal_bronze.png';
                                                    } else {
                                                        $icon = 'no';
                                                    }
                                                    ?>
                                                    <li class="list-group-item">
                                                        <img src="/assets/{{ $icon }}">({{ $aw->cat->year }}) {{ trans('app.place') }} {{ $aw->place }} - {{ $aw->page->title }}
                                                        <a href="{{ url('awards', $aw->award_cat_id) }}">{{ $aw->cat->title }} - {{ $aw->subcat->title }}</a>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item">
                                                    Dieses Spiel hat noch keine Awards. Oder es wurden noch keine hinzugefügt.
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">{{ trans('app.popularity_helper') }}</div>
                                <div class="card-body">
                                    <p>{{ trans('app.use_the_popularity_helper') }}</p>
                                    <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly'/>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($game->comments()->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">{{ trans('app.comments') }}</div>
                                    <div class="card-body">
                                        @foreach($game->comments()->get() as $comment)
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href='{{ url('users', $comment->user_id) }}'
                                                       title="{{ $comment->user->name }}">
                                                        <img
                                                                width="32px"
                                                                src='//{{ config('app.avatar_path') }}?gender=male&id={{ $comment->user_id }}'
                                                                alt="{{ $comment->user->name }}" class='media img-rounded'/>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <a href='{{ url('users', $comment->user_id) }}' title="{{ $comment->user->name }}">{{ $comment->user->name }}</a> -
                                                        {{ trans('app.posted_at') }} {{ $comment->created_at }}
                                                        @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                                            <span class='vote up'>up</span>
                                                        @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                                            <span class='vote down'>down</span>
                                                        @endif
                                                    </div>
                                                    <a href='{{ url('user', $comment->user_id) }}'
                                                       class='user'>{{ $comment->name }}</a>
                                                    {!! \App\Helpers\InlineBoxHelper::GameBox($comment->comment_html) !!}
                                                </div>


                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">{{ trans('app.comments') }}</div>
                                    <div class="card-body">
                                        {{ trans('app.no_comments_available') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">{{ trans('app.comment_rules') }}</div>
                                <div class="card-body">
                                    <p>{{ trans('app.comment_rule_1') }}</p>
                                    <p>{{ trans('app.comment_rule_2') }}</p>
                                    <p>{{ trans('app.comment_rule_3') }}</p>
                                    <p>{{ trans('app.comment_rule_4') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">{{ trans('app.add_comment') }}</div>
                                <div class="card-body">
                                    @permission(('create-game-comments'))
                                    {!! Form::open(['action' => ['CommentController@add']]) !!}
                                    {!! Form::hidden('content_id', $game->id) !!}
                                    {!! Form::hidden('content_type', 'game') !!}
                                    <div class='content'>
                                        @if(\App\Helpers\CheckRateableHelper::checkRateable('game', $game->gameid, Auth::id()) === true)
                                            <div id='prodvote'>
                                                <input type="hidden" class="rating"/>

                                                {{ trans('app.rate_this_game') }}<br>
                                                <input type='radio' name='rating' id='ratingrulez' value='up'/>
                                                <label for='ratingrulez'>{{ trans('app.rate_up') }}</label>
                                                <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked'/>
                                                <label for='ratingpig'>{{ trans('app.rate_neut') }}</label>
                                                <input type='radio' name='rating' id='ratingsucks' value='down'/>
                                                <label for='ratingsucks'>{{ trans('app.rate_down') }}</label>
                                            </div>
                                        @endif

                                        @include('_partials.markdown_editor')

                                        <div><a href='/?page=faq#markdown'>{{ trans('app.markdown_is_usable_here') }}</a>
                                        </div>
                                    </div>
                                    <div class='foot'>
                                        <input type='submit' value='Submit' id='submit'>
                                    </div>
                                    {!! Form::close() !!}
                                    @else
                                        {{ trans('app.your_permissions_are_to_low') }}
                                    @endpermission
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @else
        <h1>{{ trans('app.game_does_not_exist') }}</h1>
    @endif

    <script>
        $(function () { /* to make sure the script runs after page load */

            $('.readmore').each(function (event) { /* select all divs with the item class */

                var max_length = 1024;
                /* set the max content length before a read more link will be added */

                if ($(this).html().length > max_length) { /* check for content length */

                    var short_content = $(this).html().substr(0, max_length);
                    short_content = new DOMParser().parseFromString(short_content, "text/html").body.innerHTML;
                    /* split the content in two parts */
                    var long_content = $(this).html();

                    $(this).html(
                        '<div class="short_text">' + short_content + '<a href="#" class="read_more"><br/>mehr lesen...</a></div>' +
                        '' +
                        '<div class="more_text" style="display:none;">' + long_content + '<a href="#" class="read_less"><br/>weniger lesen...</a></div>');
                    /* Alter the html to allow the read more functionality */

                    $(this).find('a.read_more').click(function (event) { /* find the a.read_more element within the new html and bind the following code to it */

                        event.preventDefault();

                        /* hide the read more button */
                        $(this).parents('.readmore').find('.more_text').show();
                        /* show the .more_text span */
                        $(this).parents('.readmore').find('.short_text').hide();

                    });
                    $(this).find('a.read_less').click(function (event) { /* find the a.read_more element within the new html and bind the following code to it */

                        event.preventDefault();
                        /* hide the read more button */
                        $(this).parents('.readmore').find('.short_text').show();
                        /* show the .more_text span */
                        $(this).parents('.readmore').find('.more_text').hide();

                    });

                }

            });


        });
    </script>
@endsection
