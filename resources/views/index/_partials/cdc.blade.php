<div class='rmarchivtbl' id='rmarchivbox_cdc'>
    <h2>coup de coeur</h2>
    <ul class='boxlist boxlisttable'>
        <li>
                <span class="rowprod">
                    <img width="100%" src="{{ route('screenshot.show', [$cdc->game_id, 1]) }}" />
                </span>
        </li>
        <li>
            <span class='rowprod'>
                <span class='prodentry'>
                    @if($cdc->game->gamefiles)
                    <span class='typeiconlist'>
                        <span class='typei type_{{ $cdc->game->gamefiles[0]->gamefiletype->short  }}'
                              title='{{ $cdc->game->gamefiles[0]->gamefiletype->title }}'>{{ $cdc->game->gamefiles[0]->gamefiletype->title }}</span>
                    </span>
                    @endif
                    <span class="platformiconlist">
                        <span class="type type_{{ $cdc->game->maker->short }}"
                              title="{{ $cdc->game->maker->title }}">{{ $cdc->game->maker->title }}</span>
                    </span>
                    <span class='prod'><a
                                href='{{ url('games', $cdc->game_id) }}'>{{ $cdc->game->title }}
                        @if($cdc->game->subtitle)
                            <small> - {{ $cdc->game->subtitle }}</small>
                        @endif
                        </a>
                        <span><img src="/assets/lng/16/{{ strtoupper($cdc->game->language->short) }}.png" title="{{ $cdc->game->language->name }}"></span>

                    </span>
                    <span class='group'>:: {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($cdc->game_id) !!}
                    </span>
                </span>
            </span>
        </li>
    </ul>
    <div class='foot'><time datetime='{{ $cdc->created_at }}' title='{{ $cdc->created_at }}'>{{ \Carbon\Carbon::parse($cdc->created_at)->diffForHumans() }}</time> :: <a href='{{ url('cdc') }}'>more</a>...</div>
</div>