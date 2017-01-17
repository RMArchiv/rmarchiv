@extends('layouts.app')
@section('content')
    @include('awards._partials.nav')
    <div class="content">
        <div class="rmarchivtbl" id="rmarchivbox_cdcmoderator" style="width: 80%">
            <h1>
                {{ $award->pagetitle }}: {{ $award->cattitle }} - {{ $award->catyear }}
                @if($award->catmonth <> 0)
                     - {{ trans('app.misc.month.'.$award->catmonth) }}
                @endif
            </h1>

            @foreach($subcats as $subcat)
            <h2>
                {{ $subcat->subtitle }}
                @permission(('create-awards'))
                :: <small>[<a href="{{ action('AwardController@gameadd', $subcat->subid) }}">add game</a>]</small>
                @endpermission
            </h2>
            <table class="boxtable">
                @if(array_key_exists($subcat->subid, $games))
                @foreach($games[$subcat->subid] as $game)
                <tr>
                    <td width="60px">
                        <?php
                        if($game->place == 1){
                            $icon = 'medal_gold.png';
                        }elseif($game->place == 2){
                            $icon = 'medal_silver.png';
                        }elseif($game->place == 3){
                            $icon = 'medal_bronze.png';
                        }else{
                            $icon = 'no';
                        }
                        ?>
                        @if($icon != 'no')
                        Platz {{ $game->place }}<img src="/assets/{{ $icon }}" alt="{{ $game->place }}" title="{{ $game->place }}">
                        @else
                        Platz {{ $game->place  }}
                        @endif
                    </td>
                    <td width="60%">
                    <span class='typeiconlist'>
                        @if($game->gametype)
                            <span class='typei type_{{ $game_types[$game->gametype]['short'] }}' title='{{ $game->gametype }}'>{{ $game->gametype }}</span>
                        @endif
                    </span>
                        <span class='platformiconlist'>
                        <span class='typei type_{{ $game->makershort }}' title='{{ $game->makertitle }}'>{{ $game->makertitle }}</span>
                    </span>
                        <span class='prod'>
                        <a href='{{ url('games', $game->id) }}'>
                            {{ $game->title }}
                            @if($game->subtitle)
                                <small> - {{ $game->subtitle }}</small>
                            @endif
                        </a>
                    </span>
                    </td>
                    <td width="14%">
                        {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($game->id) !!}
                    </td>
                    <td>
                        {{ $game->award_desc }}
                    </td>
                </tr>
                <tr>
                @endforeach
                @endif
            </table>
            @endforeach
        </div>
    </div>
@endsection