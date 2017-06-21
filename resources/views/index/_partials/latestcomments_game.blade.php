<div class='rmarchivtbl' id='rmarchivbox_latestcomments'>
    <h2>
        {{ trans('app.latest_comments') }}
    </h2>
    <ul class='boxlist boxlisttable'>
        @foreach($latestcomments as $com)
            <li>
            <span class='rowprod'>
                <span class='prodentry'>
                    <span class='typeiconlist'>
                        @if(isset($com->game->gamefiles[0]))
                            <span class='typei type_{{ $com->game->gamefiles[0]->gamefiletype->short}}'
                                  title='{{ $com->game->gamefiles[0]->gamefiletype->title}}'>
                            {{ $com->game->gamefiles[0]->gamefiletype->title}}
                        </span>
                        @endif
                    </span>
                    <span class='platformiconlist'>
                        <span class='typei type_{{ $com->game->maker->short }}' title='{{ $com->game->maker->title }}'>
                            @{{ $com->game->maker->title }}
                        </span>
                    </span>
                    <span class='prod'>
                        <a href='{{ url('games', $com->game->id) }}'>{{ $com->game->title }}
                            @if($com->game->subtitle)
                                <small> - {{ $com->game->subtitle }}</small>
                            @endif
                        </a>
                        <span><img src="/assets/lng/16/{{ strtoupper($com->game->language->short) }}.png"
                                   title="{{ $com->game->langname }}"></span>
                    </span>
                    <span class='group'>:: {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($com->game->id) !!}
                    </span>
                </span>
            </span>
                <span class='rowuser'>
                <a class='usera' href='{{ url('users', $com->user->id) }}' title="{{ $com->user->name }}">
                    <img alt="{{ $com->user->name }}" class='avatar'
                         src='http://ava.rmarchiv.de/?gender=male&id={{ $com->user->id }}'>
                </a>
            </span>
            </li>
        @endforeach
    </ul>
    <div class='foot'>
        .
    </div>
</div>