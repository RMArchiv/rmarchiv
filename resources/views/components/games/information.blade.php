<div class="d-flex w-100">
    <div class="w-100">

        {{-- maker --}}
        <div class="d-flex align-items-stretch">
            <div class=" px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center "><i class="fa fa-gear"></i>
            </div>
            <a class="d-flex px-2 border-bottom border-rm-base w-100 align-items-center"
                href="{{ route('maker.show', $game->maker->id) }}">
                <span class="typei-nostyle type_{{ $game->maker->short }} me-1">{{ $game->maker->title }}</span>
                {{ $game->maker->title }}
            </a>
        </div>

        {{-- version --}}
        <div class="d-flex align-items-stretch">
            <div class=" px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center ">
                <i class="fa
                    @if ($game?->gamefiles?->first()?->gamefiletype?->short == 'full') fa-battery
                    @elseif($game?->gamefiles?->first()?->gamefiletype?->short == 'demo')
                    fa-battery-three-quarters
                    @elseif($game?->gamefiles?->first()?->gamefiletype?->short == 'techdemo')
                    fa-battery-half
                    @elseif($game?->gamefiles?->first()?->gamefiletype?->short == 'ptrailer')
                    fa-battery-quarter
                    @else
                    fa-battery-empty @endif
                    "></i>
            </div>
            <div class="d-flex px-2 border-bottom border-rm-base w-100 align-items-center">
                @if (count($game->gamefiles) > 0)
                    <span
                        class='typei-nostyle type_{{ $game->gamefiles->first()->gamefiletype->short }} me-1'>{{ trans('app.release_type.' . $game->gamefiles->first()->gamefiletype->short) }}</span>
                    {{ trans('app.release_type.' . $game->gamefiles->first()->gamefiletype->short) }}
                @else
                    {{ trans('app.no_gamefile_available') }}
                @endif
            </div>
        </div>

        {{-- developer --}}
        <div class="d-flex align-items-stretch">
            <div class=" px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center ">
                <i class="fa fa-palette"></i>
            </div>
            <div class="d-flex px-2 border-bottom border-rm-base w-100 align-items-center text-wrap flex-wrap">
                @foreach ($game->developers as $dev)
                    <a class="" href="{{ url('developer', $dev->developer_id) }}">{{ $dev->developer->name }}</a>
                    @if ($dev != $game->developers->last())
                        <span>&nbsp::&nbsp</span>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- release --}}
        @if (strlen(\App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id)) > 0)
            <div class="d-flex align-items-stretch">
                <div class="px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                    <i class="fa fa-calendar-days"></i>
                </div>
                <div class="d-flex px-2 border-bottom border-rm-base w-100 align-items-center">
                    {{ \App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id) }}</div>
            </div>
        @endif

        {{-- website --}}
        @if ($game->website_url)
            <div class="d-flex align-items-stretch">
                <div class=" px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center position-relative">
                    <i class="fa fa-globe"></i><i style="font-size: 0.5rem; bottom:4px; right:9px;"
                        class="position-absolute fa fa-arrow-pointer"></i>
                </div>
                <div class="d-flex px-2 border-bottom border-rm-base w-100 align-items-center">
                    <a href="{{ $game->website_url }}" target="_blank">{{ trans('app.website') }}</a>
                </div>
            </div>
        @endif

        {{-- atelier --}}
        @if ($game->atelier_id)
            <div class="d-flex align-items-stretch">
                <div class="px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                    <i class="fa-brands fa-fort-awesome"></i>
                </div>
                <div class="d-flex px-2 border-bottom border-rm-base w-100 align-items-center">
                    <a class=""
                        href="http://www.rpg-atelier.net/index.php?site=showgame&gid={{ $game->atelier_id }}"
                        target="_blank">
                        {{ trans('RPG-Atelier') }}
                        {{ trans('app.link') }}
                    </a>
                </div>
            </div>
        @endif

        {{-- pendium --}}
        @if ($game->makerpendium_article)
            <div class="d-flex align-items-stretch">
                <div class="px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                    <i class="fa fa-book"></i>
                </div>
                <div class="d-flex px-2 border-bottom border-rm-base w-100 align-items-center">
                    <a class="" href="{{ $game->makerpendium_article }}"
                        target="_blank">Makerpendium {{ trans('app.link') }}</a>
                </div>
            </div>
        @endif

        {{-- license --}}
        @if ($game->license)
            <div class="d-flex align-items-stretch">
                <div class="d-flex align-items-center border-bottom border-rm-base">
                    <div title="{{ trans('app.license') }}" aria-label="{{ trans('app.license') }}"
                        class="px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                        <i class="fa fa-section"></i>
                    </div>
                    <div class="px-2">
                        {{ $game->license->title }}
                    </div>
                </div>
            </div>
        @endif


        {{-- popularity --}}
        @php
            $perc = \App\Helpers\MiscHelper::getPopularity(
                $game->views,
                \App\Helpers\DatabaseHelper::getGameViewsMax(),
            );
        @endphp
        <div class="d-flex align-items-center">
            <div class="px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center"><i class="fa fa-meteor"></i>
            </div>

            <div class="w-100 py-1 gap-1 d-flex flex-column px-2 border-bottom border-rm-base">
                <span class="fw-semibold">{{ trans('app.popularity') }}</span>
                <x-common.progressbar :percent="$perc" hasText="true" />
                <span class="fw-semibold">
                    {{ trans('app.profile_views') }}</span> {{ number_format($game->views, 0, ',', '.') }}
            </div>
        </div>

        {{-- rating --}}
        <div class="d-flex align-items-center">
            <div class="px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center gap-2">
                <div class="d-flex gap-2">
                    <img style="filter: brightness(2) grayscale(100%)" src='/assets/rate_up.gif' width="18px"
                        alt='{{ trans('app.rate_up') }}' />
                    {{ @$game->votes['up'] ?? 0 }}
                </div>
                <div class="d-flex gap-2">
                    <img style="filter: brightness(2) grayscale(100%)" src='/assets/rate_down.gif' width="18px"
                        alt='{{ trans('app.rate_down') }}' />
                    {{ @$game->votes['down'] ?? 0 }}
                </div>
            </div>
            <div class="w-100 d-flex flex-column gap-1 border-bottom border-rm-base p-2 py-1">
                <div class="justify-self-start">
                    @if (@$game->votes['up'] > @$game->votes['down'])
                        <img src='/assets/rate_up.gif' width="18px" alt='good' />
                    @elseif(@$game->votes['up'] < @$game->votes['down'])
                        <img src='/assets/rate_down.gif' width="18px" alt='bad' />
                    @elseif(@$game->votes['down'] == @$game->votes['down'])
                        <img src='/assets/rate_neut.gif' width="18px" alt='ok' />
                    @else
                        <img src='/assets/rate_neut.gif' width="18px" alt='ok' />
                    @endif
                    &nbsp;{{ ((floatval($game->avg) + 1) / 2) * 100 ?? 0 }}%
                </div>
                <div>
                    <div class="progress border">
                        <div class="bg-primary progress-bar"
                            style="width: {{ number_format((($game->votes['up'] + 0) / 1) * 100 ?? 0, 2) }}%;"></div>
                        <div class="bg-danger-subtle progress-bar"
                            style="width: {{ number_format((($game->votes['down'] + 0) / 1) * 100 ?? 0, 2) }}%;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- gamefiles --}}
        @if (Auth::check())
            @if ($game->gamefiles->count() != 0)
                @if ($game->maker_id == 2 ?? ($game->maker_id == 3 ?? ($game->maker_id == 6 ?? $game->maker_id == 9)))
                    <div class="d-flex align-items-center">
                        <div class="px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                            <i class="fa fa-gamepad"></i>
                        </div>

                        <div class="w-100 py-1 gap-1 d-flex flex-wrap px-2 border-bottom border-rm-base flex-column">
                            <a
                                href=@if ($game->maker_id == 6) "{{ action('PlayerMvController@index', $game->gamefiles->first()->id) }}"
                                    @else
                                    "{{ action('Player2kController@index', $game->gamefiles->first()->id) }}" @endif>
                            <div class="btn btn-secondary fw-bold">
                                <i class="fa fa-gamepad"></i>
                                {{ trans('app.play_in_browser') }}!
                                {{-- <img src="/assets/play_button.png" alt="play"> --}}
                            </div>
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        @endif

        {{-- tags --}}
        <div class="d-flex align-items-center">
            <div title="{{ trans('app.tags') }}"
                class="px-1 px-lg-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                <i class="fa fa-tag"></i>
            </div>

            <div
                class="w-100 py-1 gap-1 d-flex flex-row flex-wrap px-2 border-bottom border-rm-base ">
                <div>
                    @foreach ($game->tags as $tag)
                        <small class="badge rounded-pill bg-warning text-bg-warning"><a class="text-bg-warning"
                                href="{{ action('TaggingController@showGames', [$tag->tag_id]) }}">{{ $tag->tag->title }}</a>
                            @if ($tag != $game->tags->last())
                            @endif
                        </small>
                    @endforeach
                    @if (Auth::check())
                        <div id="addtag" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ trans('app.add_tag') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <form method="POST" action="{{ action('TaggingController@store') }}"
                                                class="form-horizontal">
                                                @csrf
                                                <input type="hidden" name='content_id' value="{{ $game->id }}">
                                                <input type="hidden" name='content_type' value="{{ 'game' }}">
                                                <fieldset>
                                                    <div class="form-group" id="row_tag">
                                                        <label for="tag"
                                                            class="col-form-label">{{ trans('app.tag_name') }}</label>
                                                        <div class="d-flex gap-4">
                                                            <div class="autocomplete">
                                                                <input autocomplete="off" type="text"
                                                                    class="d-none auto form-control" id="tag"
                                                                    name="title" value="">
                                                                <div id="searchbar"></div>
                                                                <div id="searchcontainer"></div>
                                                            </div>
                                                            <input class="btn btn-secondary w-25" type='submit'
                                                                value='{{ trans('app.submit') }}' id='submit'>

                                                        </div>
                                                    </div>

                                                    <script type="module">
                                                        createAutocomplete({
                                                            apiPath: () => {
                                                                return "ac_tag"
                                                            },
                                                            placeholder: "{{ trans('app.search') }}",
                                                            searchbarSelector: "#row_tag #searchbar",
                                                            panelSelector: "#searchcontainer",
                                                            noResults:'{{ trans('app.search_nothing_found') }}',
                                                            type: "list",
                                                            action: "find",
                                                            limit: 5,
                                                            inputSelector: ".autocomplete #tag",
                                                            // disable detached mode because input does not work in nested bootstrap modal
                                                            additionalProps: {
                                                                detachedMediaQuery: "none"
                                                            }
                                                        })
                                                    </script>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <x-common.iconbutton class="mw-50 mt-2" icon="fa fa-tag" data-bs-toggle="modal" data-bs-target="#addtag">{{ trans('app.add_tag') }}</x-common.iconbutton>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end align-items-center gap-2 px-2" style="zoom: 75%;">
            <div class="d-block d-md-flex flex-column d-lg-block">{{ trans('app.submitted_by') }} <a href='{{ url('users', $game->user_id) }}'
                class='user word-hyphens'>{{ $game->user->name }}</a>
            <a href='{{ url('users', $game->user_id) }}' class='usera' title="{{ $game->user->name }}">
                <img width="16px" src='//{{ config('app.avatar_path') }}?gender=male&id={{ $game->user_id }}'
                    alt="{{ $game->user->name }}" class='avatar' />
            </a></div>
            <small>
                <time datetime='{{ $game->created_at }}'
                    title='{{ $game->created_at }}'>({{ \Carbon\Carbon::parse($game->created_at)->diffForHumans() }})
                </time>
            </small>
            <a
                href="{{ action('ReportController@create_game_report', $game->id) }}">{{ trans('app.report_game') }}</a>
        </div>
    </div>
</div>
