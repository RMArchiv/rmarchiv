<div class='rmarchivtbl' id='rmarchivbox_latestadded'>
    <h2>{{ trans('index.topmonth.title') }}</h2>
    <ul class='boxlist boxlisttable'>
        @foreach($topmonth as $g)
            <li>
            <span class='rowprod'>
                <span class='prodentry'>
                    @if(is_null($g->gametype) == false)
                        <span class='typeiconlist'>
                        <span class='typei type_{{ $gametypes[$g->gametype]['short'] }}' title='{{ $gametypes[$g->gametype]['title'] }}'>{{ $gametypes[$g->gametype]['title'] }}</span>
                    </span>
                    @endif
                    <span class="platformiconlist">
                        <span class="typei type_{{ $g->makershort }}" title="{{ $g->makertitle }}">{{ $g->makertitle }}</span>
                    </span>
                    <span class='prod'>
                        <a href='{{ url('games',$g->gameid) }}'>{{ $g->gametitle }}
                            @if($g->gamesubtitle != '')
                                <small> - {{ $g->gamesubtitle }}</small>
                            @endif
                        </a>
                                                <span><img src="/assets/lng/16/{{ strtoupper($g->lang_short) }}.png" title="{{ $g->lang_name }}"></span>

                    </span>
                    <span class='group'>
                        :: {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($g->gameid) !!}
                    </span>
                </span>
            </span>
            </li>
        @endforeach
    </ul>
    <div class='foot'><a href='{{ url('games') }}'>{{ trans('index.topmonth.more') }}</a>...</div>
</div>