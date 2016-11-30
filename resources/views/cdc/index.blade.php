@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="rmarchivtbl" id="rmarchivbox_cdcmoderator">
            <h2>coup de coeur history</h2>

            <table class="boxtable">
                <thead>
                    <tr class='sortable'>
                        <th>spielname</th>
                        <th>entwickler</th>
                        <th>ernannt am</th>
                    </tr>
                </thead>
                @foreach($cdcs as $cdc)
                    <tr>
                        <td>
                            @if(is_null($cdc->gametype) == false)
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
                        </td>
                        <td>
                            <a href="{{ url('developers', $cdc->developerid) }}">{{ $cdc->developername }}</a>
                        </td>
                        <td>
                            {{ $cdc->cdcdate  }}
                        </td>
                    </tr>
                    <tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection