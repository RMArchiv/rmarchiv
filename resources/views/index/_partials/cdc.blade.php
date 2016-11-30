<div class='rmarchivtbl' id='rmarchivbox_cdc'>
    <h2>coup de coeur</h2>
    <ul class='boxlist boxlisttable'>
        <li>
                <span class="rowprod">
                    <img width="100%" src="{{ route('screenshot.show', [$cdc->gameid, 1]) }}" />
                </span>
        </li>
        <li>
            <span class='rowprod'>
                <span class='prodentry'>
                    @if($cdc->gametype)
                    <span class='typeiconlist'>
                        <span class='typei type_{{ $gametypes[$cdc->gametype]['short'] }}'
                              title='{{ $gametypes[$cdc->gametype]['title']}}'>{{ $gametypes[$cdc->gametype]['title'] }}</span>
                    </span>
                    @endif
                    <span class="platformiconlist">
                        <span class="type type_{{ $cdc->makershort }}"
                              title="{{ $cdc->makertitle }}">{{ $cdc->makertitle }}</span>
                    </span>
                    <span class='prod'><a
                                href='{{ url('games', $cdc->gameid) }}'>{{ $cdc->gametitle }}
                        @if($cdc->gamesubtitle)
                            <small> - {{ $cdc->gamesubtitle }}</small>
                        @endif
                        </a></span>
                    <span class='group'>:: <a
                                href="{{ url('developers', $cdc->developerid) }}">{{ $cdc->developername }}</a>
                    </span>
                </span>
            </span>
        </li>
    </ul>
    <div class='foot'>seit {{ $cdc->cdcdate }} :: <a href='{{ url('cdc') }}'>more</a>...</div>
</div>