<div class="row mt-4">
    <div class="col-md-12">
        <ul class="list-group">
            <li class="list-group-item active">
                {{ trans('app.top_of_the_month') }}
            </li>
            @foreach($topmonth as $g)
                <li class="list-group-item">
                    <span class='rowprod'>
                        <span class='prodentry'>
                            @if(!is_null($g->release_type) && isset($gametypes[$g->release_type]))
                                <span class='typeiconlist'>
                                    <span class='typei type_{{ $gametypes[$g->release_type]['short'] }}'
                                          title='{{ $gametypes[$g->release_type]['title'] }}'>{{ $gametypes[$g->release_type]['title'] }}</span>
                                </span>
                            @endif
                                <span class="platformiconlist">
                        <span class="typei type_{{ $g->maker->short }}" title="{{ $g->maker->title }}">{{ $g->maker->title }}</span>
                    </span>
                    <span class='prod'>
                        <a href='{{ url('games',$g->id) }}'>{{ $g->title }}
                            @if($g->subtitle != '')
                                <small> - {{ $g->subtitle }}</small>
                            @endif
                        </a>
                                                <span><img src="/assets/lng/16/{{ strtoupper($g->language->short) }}.png" title="{{ $g->language->name }}"></span>

                    </span>
                    <span class='group'>
                        :: {!! $g->developer_links !!}
                    </span>
                        </span>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
