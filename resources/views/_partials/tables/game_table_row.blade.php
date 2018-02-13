<li class="list-group-item media" style="margin-top: 0px;">
    <a class="pull-right" href="{{ url('games', $game->id) }}"><span class="badge">{{ $game->comments }}</span></a>
    <a class="pull-left" href="{{ url('games', $game->id) }}"><img width="100px" class="img-responsive img-rounded" src='{{ route('screenshot.show', [$game->id, 1]) }}' alt='{{ trans('app.titlescreen') }}' title='{{ trans('app.titlescreen') }}'/></a>
    <div class="thread-info">
        <div class="media-heading">
            @if($game->gamefiles->count() > 0)
                <span class='typeiconlist'>
                <span class='typei type_{{ $game->gamefiles->first()->gamefiletype->short }}'
                      title='{{ $game->gamefiles->first()->gamefiletype->title }}'>{{ $game->gamefiles->first()->gamefiletype->title }}</span>
            </span>
            @endif
            <span class="platformiconlist">
            <a href="{{ route('maker.show', $game->maker->id) }}">
                <span class="typei type_{{ $game->maker->short }}" title="{{ $game->maker->title }}">
                    {{ $game->maker->title }}
                </span>
            </a>
        </span>
                <a href='{{ url('games', $game->id) }}'>
                    {{ $game->title }}
                    @if($game->subtitle)
                        <small> - {{ $game->subtitle }}</small>
                    @endif
                    <span><img src="/assets/lng/16/{{ strtoupper($game->language->short) }}.png"
                               title="{{ $game->language->name }}"></span>
                </a>
                @if($game->cdcs->count() > 0)
                    <div class="cdcstack">
                        <img src="/assets/cdc.png" title="{{ trans('app.coupdecoeur') }}" alt="{{ trans('app.coupdecoeur') }}">
                    </div>
                @endif
        </div>
        <div class="media-body" style="font-size: 12px;">
            {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($game->id) !!}<br>
            release date:
            @if(\Carbon\Carbon::parse($game->release_date)->year != -1 )
                {{ $game->release_date }}
            @else
                {{ \Carbon\Carbon::parse(\App\Helpers\DatabaseHelper::getReleaseDateFromGameId($game->id))->toDateString() }}
            @endif
            <span> • </span>
            hinzugefügt {{ \Carbon\Carbon::parse($game->created_at)->diffForHumans() }}
            <span> • </span>
            <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/> {{ $game->voteup or 0 }} -
            <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/> {{ $game->votedown or 0 }}
            <span> • </span>
            AVG: {{ number_format(floatval($game->avg), 2) }}&nbsp;
            @if($game->avg > 0)
                <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/>
            @elseif($game->avg == 0)
                <img src='/assets/rate_neut.gif' alt='{{ trans('app.rate_neut') }}'/>
            @elseif($game->avg < 0)
                <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/>
            @endif
            <div class="pull-right">
                @foreach($game->tags as $tag)
                    <a href="{{ action('TaggingController@showGames', [$tag->tag_id]) }}"><span class="badge badge-pill">{{ $tag->tag->title }}</span></a>
                @endforeach
            </div>
        </div>
    </div>
</li>