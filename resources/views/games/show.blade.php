@extends('layouts.app')
@section('pagetitle', $game->title.' - '.$game->subtitle)
@section('content')
    @if($game)
        @php
            $thumbnailWidth = '12.5%';
        @endphp
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header d-flex flex-row justify-content-between">
                        <h1>
                            <span id='title'><big>{{ $game->title }}</big>@if($game->subtitle) :: {{ $game->subtitle }}@endif</span>
                        </h1>
                        @if(Auth::check())
                            <div class='btn-toolbar align-self-start'>
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
                                           data-bs-toggle="userlist"
                                           data-bs-content="{!! $ul_data !!}"
                                           title="{{trans('app.userlist')}}"
                                           >
                                            <span class="fa fa-list"></span></a>
                                        @permission(('create-games'))
                                        <a href="{{ route('history.game.index', ['id' => $game->id]) }}" role='button' class='btn btn-primary'><span class="fa fa-history"></span></a>
                                        <a href="{{ action('GameController@edit', [ 'id' => $game->id]) }}" role="button" class="btn btn-primary"><span class="fa fa-edit"></span></a>
                                        @endpermission
                                    @endif

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                {!! Breadcrumbs::render('game', $game) !!}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row mt-4">
                        <div class='col-lg-6'>
                            {{-- screenshots --}}
                            @if(\App\Models\GamesFile::whereGameId($game->id)->where("forbidden", '=', 1)->get()->count() != 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-white bg-danger">
                                        <div class="card-header">Gesperrte Downloads</div>
                                        <div class="card-body">
                                            <h5 class="card-title">Dieses Spiel enthält entfernte Downloads</h5>
                                            <p class="card-text">
                                                Mindestens eine Datei in diesem Spiel wurde gemeldet und ensprechend entfernt.

                                                @foreach($game->gamefiles as $f)
                                                    <li class="list-group-item bg-danger">
                                                        @if($f->forbidden == 1)
                                                            {{ $f->gamefiletype->title }} - {{ $f->release_version }}: {{ $f->reason }}
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="screenshot-carousel-fade" class="carousel w-100 h-100 slide carousel-fade">
                                                @if(count($screenshots) > 0)
                                                <div class="carousel-content-container position-relative">
                                                    <div class="carousel-inner">
                                                        @for($i = 1; $i <= count($screenshots); $i++)
                                                            <div class="{{'carousel-item ' . ($i==1 ? 'active':'')}}">
                                                                <img onerror="this.onerror=null; this.src='/assets/no_image.png'"  class="d-block w-100" style="" src='{{ route('screenshot.show', [$game->id, $i]) }}'
                                                                            alt='{{ $i==1 ? trans('app.screenshot'):trans('app.titlescreen') }}' title='{{ $i==1 ? trans('app.screenshot'):trans('app.titlescreen') }}'/>
                                                            <div class="mt-2 d-flex gap-2">
                                                                <x-common.iconbutton showtextfrom="lg" icon="fa fa-expand" :href="route('screenshot.show', [$game->id, $i, $i])">{{ trans('app.show_original_size') }}</x-common.iconbutton>
                                                                @if(Auth::check())
                                                                    <x-common.iconbutton showtextfrom="lg" icon="fa fa-upload" :href="route('screenshot.create', [$game->id, $i])">{{ $i==1 ? trans('app.upload.replace.titlescreen') : trans('app.upload.replace.screenshot')}}</x-common.iconbutton>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @endfor
                                                    @if($game->youtube)
                                                        @php
                                                            $vid = str_replace('watch?v=', "embed/", $game->youtube);
                                                        @endphp
                                                            <div class="carousel-item w-100 h-fit">
                                                                <div class="ratio ratio-16x9">
                                                                    <iframe class="embed-responsive-item" src="{{ $vid }}" frameborder="0" allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                    @endif
                                                    </div>
                                                    @if(count($screenshots) > 1)
                                                        <a class="carousel-control-prev" style="max-height: 90%" type="button" data-bs-target="#screenshot-carousel-fade" data-bs-slide="prev">
                                                            <span style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 1);" class="bg-black w-auto rounded-pill p-1  fa fa-arrow-left" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" style="max-height: 90%" type="button" data-bs-target="#screenshot-carousel-fade" data-bs-slide="next">
                                                            <span style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 1);" class="bg-black w-auto rounded-pill p-1  fa fa-arrow-right" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Next</span>
                                                        </a>
                                                    @endif
                                                </div>
                                                @else
                                                <img class="d-block w-100" style="" src='{{ route('screenshot.show', [$game->id, 1]) }}'
                                                    alt='{{ trans('app.titlescreen') }}' title='{{ trans('app.titlescreen') }}'/>
                                                @endif
                                                <div class="d-flex flex-wrap mt-2 row-gap-1">
                                                    @for($i = 1; $i <= count($screenshots); $i++)
                                                        <button type="button" data-bs-target="#screenshot-carousel-fade" data-bs-slide-to="{{$i-1}}" style="width:{{ $thumbnailWidth }}" class=" carousel-control {{' ' . ($i==1 ? 'active':'')}} btn btn-link p-0">
                                                            <img  onerror="this.onerror=null; this.src='/assets/no_image.png'" class="w-100 d-block" style=";" src='{{ route('screenshot.show', [$game->id, $i]) }}'
                                                                        alt='{{ $i==1 ? trans('app.screenshot'):trans('app.titlescreen') }}' title='{{ $i==1 ? trans('app.screenshot'):trans('app.titlescreen') }}'/>
                                                        </button>
                                                    @endfor
                                                    @if($game->youtube)
                                                        @php
                                                            $vid = str_replace('watch?v=', "embed/", $game->youtube);
                                                        @endphp
                                                        <button type="button" data-bs-target="#screenshot-carousel-fade" data-bs-slide-to="{{count($screenshots)}}" style="width:{{ $thumbnailWidth }}" class=" position-relative d-flex align-items-center justify-content-center btn btn-secondary">
                                                        <i class="fa fa-video fs-4"></i>
                                                        </button>
                                                    @endif

                                                    @if(count($screenshots) < $maxScreenshotCount && Auth::check())
                                                        <a href="{{ route('screenshot.create', [$game->id, count($screenshots)+1]) }}" title={{trans('app.upload.titlescreen')}} style="width:{{ $thumbnailWidth }}" class=" position-relative d-flex align-items-center justify-content-center btn btn-secondary">
                                                            <i class="fa fa-image fs-4"></i>
                                                            <div class="w-100 h-100 position-absolute top-0">
                                                            <div style="width:12px; height:13px" class="me-1 end-0 bg-black fs-4 position-absolute">
                                                            </div>
                                                            <i style="font-size:15px !important" class="end-0 text-white fs-4 fa fa-square-plus position-absolute"></i>
                                                            </div>
                                                        </a>
                                                    @endif

                                                    @if(Auth::check() && (!isset($game->youtube) || strlen($game->youtube) == 0))
                                                        <a href="{{ action('GameController@edit', [ 'id' => $game->id]) }}#trailer" title={{trans('app.upload.titlescreen')}} style="width:{{ $thumbnailWidth }}" class=" position-relative d-flex align-items-center justify-content-center btn btn-secondary">
                                                        <i class="fa fa-video fs-4"></i>
                                                            <div class="w-100 h-100 position-absolute top-0">
                                                            <div style="width:12px; height:13px" class="me-1 end-0 bg-black fs-4 position-absolute">
                                                            </div>
                                                            <i style="font-size:15px !important" class="end-0 text-white fs-4 fa fa-square-plus position-absolute"></i>
                                                            </div>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            {{-- infos & stats --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header" style="position: relative">
                                            {{ trans('app.information') }}

                                            {{-- gamefiles --}}
                                            @if (Auth::check())
                                                @if ($game->gamefiles->count() != 0)
                                                    @if ($game->maker_id == 2 ?? ($game->maker_id == 3 ?? ($game->maker_id == 6 ?? $game->maker_id == 9)))
                                                        <div class="d-flex align-items-center">
                                                            <div class="ms-4 bg-rm-back h-100 w-100"></div>
                                                            <div class="" style="position:absolute; right:2px;top:3px">
                                                                <a
                                                                    href=@if ($game->maker_id == 6) "{{ action('PlayerMvController@index', $game->gamefiles->first()->id) }}"
                                                                        @else
                                                                        "{{ action('Player2kController@index', $game->gamefiles->first()->id) }}" @endif>
                                                                    <div class="btn btn-primary btn-sm">
                                                                        <i class="fa fa-gamepad"></i>
                                                                        <small class="d-none d-xxl-inline-block">{{ trans('app.play_in_browser') }}!</small>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif

                                        </div>
                                        <x-games.information :game="$game" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('app.downloads') }}
                                        </div>
                                        <ul class="list-group">
                                            @foreach($game->gamefiles as $f)
                                                @if($f->forbidden == 0)
                                                    <a class="link-underline" href="{{ url('games/download', [$f->id, time()]) }}">
                                                @endif
                                                    <li class="list-group-item small">
                                                        {{-- mobile/medium/fullwidth --}}
                                                        <small class="d-lg-none fw-normal py-1" title="{{date("Y-m-d", mktime(0, 0, 0, $f->release_month, $f->release_day, $f->release_year))}}">{{date("Y-m-d", mktime(0, 0, 0, $f->release_month, $f->release_day, $f->release_year))}}</small>
                                                        <small class="d-none d-xxl-inline-block fw-normal py-1" title="{{date("Y-m-d", mktime(0, 0, 0, $f->release_month, $f->release_day, $f->release_year))}}">{{date("Y-m-d", mktime(0, 0, 0, $f->release_month, $f->release_day, $f->release_year))}}</small>
                                                        <small class="d-none d-xxl-none d-lg-inline-block fw-normal py-1" title="{{date("Y-m-d", mktime(0, 0, 0, $f->release_month, $f->release_day, $f->release_year))}}">{{date("Y-m", mktime(0, 0, 0, $f->release_month, $f->release_day, $f->release_year))}}</small>
                                                        @if($f->language)
                                                            <img class="me-1" src="/assets/lng/16/{{ strtoupper($f->language->short) }}.png" title="{{ $f->language->name }}">
                                                        @endif
                                                        <span class="badge float-end">{{ $f->downloadcount }}</span>

                                                        <small class="small">
                                                        @if($f->forbidden == 0)
                                                        <span class="down_l text-warning">
                                                            {{ $f->gamefiletype->title }} - {{ $f->release_version }}
                                                        </span>
                                                        @else
                                                            {{ $f->gamefiletype->title }} - {{ $f->release_version }}
                                                        @endif
                                                        </small>

                                                </li>
                                                @if($f->forbidden == 0)
                                                </a>
                                                @endif

                                            @endforeach
                                        </ul>
                                        <div style="height: 1px" class="bg-secondary"></div>
                                        <div class="px-3 py-2">
                                            <a href="{{ action('GameFileController@create', $game->id) }}">{{ trans('app.gamefile_list_and_add') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class='col-lg-6'>
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
                        <div class="col-lg-6">
                            {{-- awards --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">{{ trans('app.awards') }}</div>
                                        <ul class="list-group">
                                            @if(count($game?->awards ?? []) > 0)
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
                                                    {{ trans('app.game_no_awards') }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        {{-- credits --}}
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">{{ trans('app.user_credits') }}</div>
                                                <ul class="list-group">
                                                    @if ($game->credits->count() != 0)
                                                        @foreach ($game->credits as $cr)
                                                            <li class="list-group-item">
                                                                <a href='{{ url('users', $cr->user_id) }}' class='usera'
                                                                    title="{{ $cr->user->name }}"><img width="16px"
                                                                        src='//{{ config('app.avatar_path') }}?gender=male&id={{ $cr->user_id }}'
                                                                        alt="{{ $cr->user->name }}" class='avatar' />
                                                                </a>
                                                                <a href='{{ url('users', $cr->user_id) }}'
                                                                    class='user'>{{ $cr->user->name }}</a>
                                                                [{{ $cr->type->title }}]
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li class="list-group-item">{{ trans('app.no_user_credits_added') }}
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
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
                                    <input type='text' value='{{ Request::fullUrl() }}' style="width:100%" readonly='readonly'/>
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
                                                    <div class="media-heading d-flex gap-1">
                                                        <a href='{{ url('users', $comment->user_id) }}' title="{{ $comment->user->name }}">{{ $comment->user->name }}</a> -
                                                        {{ trans('app.posted_at') }} {{ $comment->created_at }}
                                                        <span class="float-end">
                                                            @include('reports._partials.report-button', [
                                                                'reportType' => 'comment',
                                                                'reportId' => $comment->id,
                                                                'reportLabel' => $game->title,
                                                            ])
                                                        </span>
                                                        @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                                            <span class='d-flex align-items-center vote up'><img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/></span>
                                                        @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                                            <span class='d-flex align-items-center vote down'><img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/></span>
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
                                    <ul class="mb-0">
                                        <li>{{ trans('app.comment_rule_1') }}</li>
                                        <li>{{ trans('app.comment_rule_2') }}</li>
                                        <li>{{ trans('app.comment_rule_3') }}</li>
                                        <li>{{ trans('app.comment_rule_4') }}</li>
                                    </ul>
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
                                    <form method="POST" action="{{action('CommentController@add')}}">
                                        @csrf
                                    <input type="hidden" name='content_id' value="{{ $game->id }}">
                                    <input type="hidden" name='content_type' value="{{ 'game' }}">
                                    <div class='content'>
                                        @if(\App\Helpers\CheckRateableHelper::checkRateable('game', $game->id, Auth::id()) === true)
                                            <div id='prodvote' class="d-flex gap-4 p-3  bg-rm-back-alpha">
                                                <input type="hidden" class="d-none"/>
                                                <div class="fw-medium">{{ trans('app.rate_this_game') }} </div>
                                                <div>
                                                    <input class="form-check-input" type='radio' name='rating' id='ratingrulez' value='up'/>
                                                    <label for='ratingrulez'><img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/></label>
                                                </div>
                                                <div>
                                                    <input class="form-check-input" type='radio' name='rating' id='ratingsucks' value='down'/>
                                                    <label for='ratingsucks'><img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/></label>
                                                </div>
                                                <div>
                                                    <input class="form-check-input" type='radio' name='rating' id='ratingpig' value='neut' checked='checked'/>
                                                    <label class="w-4" for='ratingpig'>{{ trans('app.rating.dont_rate') }}</label>
                                                </div>

                                            </div>
                                        @endif

                                        @include('_partials.markdown_editor')

                                        <div><a href='/?page=faq#markdown'>{{ trans('app.markdown_is_usable_here') }}</a>
                                        </div>
                                    </div>
                                    <div class='foot mt-1'>
                                        <button class="btn btn-primary" id='submit'>{{ trans('app.submit') }}</button>
                                    </div>
                                    </form>
                                    @else
                                        {{ trans('app.your_permissions_are_too_low') }}
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
    <script type="module">
        window.onload=function () {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="userlist"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {sanitize:true, html:true}))
        };
    </script>
    <script type="module">
        document.addEventListener('DOMContentLoaded', function () { /* to make sure the script runs after page load */

            document.querySelectorAll('.readmore').forEach(function (section) { /* select all divs with the item class */

                var max_length = 1024;
                /* set the max content length before a read more link will be added */

                if (section.innerHTML.length > max_length) { /* check for content length */

                    var short_content = section.innerHTML.substr(0, max_length);
                    short_content = new DOMParser().parseFromString(short_content, "text/html").body.innerHTML;
                    /* split the content in two parts */
                    var long_content = section.innerHTML;

                    section.innerHTML ='<div class="short_text">' + short_content + '<a href="#" class="read_more"><br/>mehr lesen...</a></div>' +
                        '' +
                        '<div class="more_text" style="display:none;">' + long_content + '<a href="#" class="read_less"><br/>weniger lesen...</a></div>';
                    /* Alter the html to allow the read more functionality */

                    section.querySelector('a.read_more').addEventListener("click", function (event) { /* find the a.read_more element within the new html and bind the following code to it */

                        event.preventDefault();

                        /* hide the read more button */
                        event.currentTarget.closest('.readmore').querySelector('.more_text').style.display = "block";
                        /* show the .more_text span */
                        event.currentTarget.closest('.readmore').querySelector('.short_text').style.display = "none";
                    });
                    section.querySelector('a.read_less').addEventListener("click", function (event) { /* querySelector the a.read_more element within the new html and bind the following code to it */

                        event.preventDefault();
                        /* hide the read more button */
                        event.currentTarget.closest('.readmore').querySelector('.short_text').style.display = "block";
                        /* show the .more_text span */
                        event.currentTarget.closest('.readmore').querySelector('.more_text').style.display = "none";
                        section.scrollIntoView({ behavior: 'smooth' });
                    });
                }
            });
        });
    </script>
@endsection
