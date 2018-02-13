<div class="row mt-4">
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item active">
                {{ trans('app.latest_released_games') }}
            </li>
            @foreach($latestreleased as $g)
                <li class="list-group-item">
                    <span class='rowprod'>
                        <span class='prodentry'>
                            @if(isset($g->gamefiles[0]))
                                <span class='typeiconlist'>
                                    <span class='typei type_{{ $g->gamefiles[0]->gamefiletype->short }}'
                                          title='{{ $g->gamefiles[0]->gamefiletype->title }}'>{{ $g->gamefiles[0]->gamefiletype->title }}</span>
                                </span>
                            @endif
                            <span class="platformiconlist">
                                <a href="{{ route('maker.show', $g->maker->id) }}">
                                    <span class="typei type_{{ $g->maker->short }}" title="{{ $g->maker->title }}">
                                        {{ $g->maker->title }}
                                    </span>
                                </a>
                            </span>
                            <span class='prod'>
                                <a href='{{ url('games',$g->id) }}'>{{ $g->title }}
                                    @if($g->subtitle != '')
                                        <small> - {{ $g->subtitle }}</small>
                                    @endif
                                </a>
                                <span><img src="/assets/lng/16/{{ strtoupper($g->language->short) }}.png"
                                           title="{{ $g->langname }}"></span>
                            </span>
                            <span class='group'>
                                :: {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($g->id) !!}
                            </span>
                        </span>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>