<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ trans('app.coupdecoeur') }}</div>
            <div class="card-body">
                <a href='{{ url('games', $cdc->game_id) }}'>
                    <img width="100%" src="{{ route('screenshot.show', [$cdc->game_id, 1]) }}"/>
                </a>
            </div>
            <div class="card-footer">
                <span class='rowprod'>
                    <span class='prodentry'>
                        @if($cdc->game->gamefiles)
                            <span class='typeiconlist'>
                            <span class='typei type_{{ $cdc->game->gamefiles[0]->gamefiletype->short  }}'
                                  title='{{ $cdc->game->gamefiles[0]->gamefiletype->title }}'>{{ $cdc->game->gamefiles[0]->gamefiletype->title }}</span>
                        </span>
                        @endif
                        <span class="platformiconlist">
                            <a href="{{ route('maker.show', $cdc->game->maker->id) }}">
                                <span class="typei type_{{ $cdc->game->maker->short }}" title="{{ $cdc->game->maker->title }}">
                                    {{ $cdc->game->maker->title }}
                                </span>
                            </a>
                        </span>
                        <span class='prod'>
                            <a href='{{ url('games', $cdc->game_id) }}'>
                                {{ $cdc->game->title }}
                                @if($cdc->game->subtitle)
                                    <small> - {{ $cdc->game->subtitle }}</small>
                                @endif
                            </a>
                            <span>
                                <img src="/assets/lng/16/{{ strtoupper($cdc->game->language->short) }}.png" title="{{ $cdc->game->language->name }}">
                            </span>
                        </span>
                        <span class='group'>
                            :: {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($cdc->game_id) !!}
                        </span>
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>