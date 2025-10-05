<div class="d-flex w-100">
    <div class="w-100">

        <div class="d-flex align-items-stretch">
            <div class=" px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center "><i class="fa fa-gear"></i>
            </div>
            <a class="d-flex px-2 border-bottom border-start border-rm-back-alpha w-100 align-items-center"
                href="{{ route('maker.show', $game->maker->id) }}">
                <span class="typei-nostyle type_{{ $game->maker->short }} me-1">{{ $game->maker->title }}</span>
                {{ $game->maker->title }}
            </a>
        </div>
        <div class="d-flex align-items-stretch">
            <div class=" px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center ">
                <i class="fa
                    @if ($game->gamefiles->first()->gamefiletype->short == 'full') fa-battery
                    @elseif($game->gamefiles->first()->gamefiletype->short == 'demo')
                    fa-battery-three-quarters
                    @elseif($game->gamefiles->first()->gamefiletype->short == 'techdemo')
                    fa-battery-half
                    @elseif($game->gamefiles->first()->gamefiletype->short == 'ptrailer')
                    fa-battery-quarter
                    @else
                    fa-battery-empty @endif
                    "></i>
            </div>
            <div class="d-flex px-2 border-bottom border-start border-rm-back-alpha w-100 align-items-center">
                @if (count($game->gamefiles) > 0)
                    <span
                        class='typei-nostyle type_{{ $game->gamefiles->first()->gamefiletype->short }} me-1'>{{ trans('app.release_type.' . $game->gamefiles->first()->gamefiletype->short) }}</span>
                    {{ trans('app.release_type.' . $game->gamefiles->first()->gamefiletype->short) }}
                @else
                    {{ trans('app.no_gamefile_available') }}
                @endif
            </div>
        </div>
        <div class="d-flex align-items-stretch">
            <div class=" px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center ">
                <i class="fa fa-palette"></i>
            </div>
            <div class="d-flex px-2 border-bottom border-start border-rm-back-alpha w-100 align-items-center text-wrap">
                @foreach ($game->developers as $dev)
                    <a class="" href="{{ url('developer', $dev->developer_id) }}">{{ $dev->developer->name }}</a>
                    @if ($dev != $game->developers->last())
                        ::
                    @endif
                @endforeach
            </div>
        </div>
        @if (strlen(\App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id)) > 0)
            <div class="d-flex align-items-stretch">
                <div class="px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                    <i class="fa fa-calendar-days"></i>
                </div>
                <div class="d-flex px-2 border-bottom border-start border-rm-back-alpha w-100 align-items-center">
                    {{ \App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id) }}</div>
            </div>
        @endif

        @if ($game->website_url)
            <div class="d-flex align-items-stretch">
                <div class=" px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center position-relative">
                    <i class="fa fa-globe"></i><i style="font-size: 0.5rem; bottom:4px; right:9px;"
                        class="position-absolute fa fa-arrow-pointer"></i>
                </div>
                <div class="d-flex px-2 border-bottom border-start border-rm-back-alpha w-100 align-items-center">
                    <a href="{{ $game->website_url }}" target="_blank">{{ trans('app.website') }}</a>
                </div>
            </div>
        @endif
        @if ($game->atelier_id)
            <div class="d-flex align-items-stretch">
                <div class="px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center"
                    style="filter: brightness(1.4) grayscale(100%)">
                    <img src="https://rpg-atelier.net/template/favicon.ico" width="18px" />
                </div>
                <div class="d-flex px-2 border-bottom border-start border-rm-back-alpha w-100 align-items-center">
                    <a class=""
                        href="http://www.rpg-atelier.net/index.php?site=showgame&gid={{ $game->atelier_id }}"
                        target="_blank">
                        {{ trans('app.atelier_link') }}
                    </a>
                </div>
            </div>
        @endif
        @if ($game->makerpendium_article)
            <div class="d-flex align-items-stretch">
                <div class="px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                    <i class="fa fa-book"></i>
                </div>
                <div class="d-flex px-2 border-bottom border-start border-rm-back-alpha w-100 align-items-center">
                    <a class="" href="{{ $game->makerpendium_article }}"
                        target="_blank">{{ trans('Makerpendium Link') }}</a>
                </div>
            </div>
        @endif
        @if ($game->license)
            <div class="d-flex align-items-stretch">
                <div class="d-flex align-items-center border-bottom border-start border-rm-back-alpha">
                    <div title="{{ trans('app.license') }}" aria-label="{{ trans('app.license') }}"
                        class="px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                        <i class="fa fa-section"></i>
                    </div>
                    <div class="px-2">
                        {{ $game->license->title }}
                    </div>
                </div>
            </div>
        @endif



        @php
            $perc = \App\Helpers\MiscHelper::getPopularity(
                $game->views,
                \App\Helpers\DatabaseHelper::getGameViewsMax(),
            );
        @endphp
        <div class="d-flex align-items-center">
            <div class="px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center"><i class="fa fa-meteor"></i>
            </div>

            <div class="w-100 py-1 gap-1 d-flex flex-column px-2 border-bottom border-start border-rm-back-alpha">
                <span class="fw-semibold">{{ trans('app.popularity') }}</span>
                <x-common.progressbar :percent="$perc" hasText="true" />
                <span class="fw-semibold">
                    {{ trans('app.profile_views') }}</span> {{ number_format($game->views, 0, ',', '.') }}
            </div>
        </div>

        <div class="d-flex align-items-center">
            <div class="px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center gap-2"
                style="filter: brightness(1.4) grayscale(100%)">
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
            <div class="w-100 d-flex flex-column gap-1 border-start border-rm-back-alpha p-2 py-1">
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
        @if (Auth::check())
            @if ($game->gamefiles->count() != 0)
                @if ($game->maker_id == 2 ?? ($game->maker_id == 3 ?? ($game->maker_id == 6 ?? $game->maker_id == 9)))
                    <div class="d-flex align-items-center">
                        <div class="px-3 py-2 bg-rm-back align-self-stretch d-flex align-items-center">
                            <i class="fa fa-gamepad"></i>
                        </div>

                        <div class="w-100 py-1 gap-1 d-flex flex-column">
                            <div class="btn btn-secondary fw-bold">
                                {{ trans('app.play_in_browser') }}!
                                <a
                                    href=@if ($game->maker_id == 6) "{{ action('PlayerMvController@index', $game->gamefiles->first()->id) }}"
                                        @else
                                            "{{ action('Player2kController@index', $game->gamefiles->first()->id) }}" @endif>
                                    <img src="/assets/play_button.png" alt="play"></a>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endif

        <div class="card-footer d-flex justify-content-end align-items-center gap-2 px-2" style="zoom: 75%;">
            {{ trans('app.submitted_by') }} <a href='{{ url('users', $game->user_id) }}'
                class='user'>{{ $game->user->name }}</a>
            <a href='{{ url('users', $game->user_id) }}' class='usera' title="{{ $game->user->name }}">
                <img width="16px" src='//{{ config('app.avatar_path') }}?gender=male&id={{ $game->user_id }}'
                    alt="{{ $game->user->name }}" class='avatar' />
            </a>
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
