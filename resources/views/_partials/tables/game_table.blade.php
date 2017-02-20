<table id='rmarchiv_prodlist' class='boxtable pagedtable'>
    @include('_partials.tables.game_table_head')

    @php
        $maxviews = \App\Helpers\DatabaseHelper::getGameViewsMax()
    @endphp

    @foreach($games as $game)
        @include('_partials.tables.game_table_row', ['game' => $game, 'maxviews' => $maxviews])
    @endforeach
    @if($games instanceof \Illuminate\Pagination\LengthAwarePaginator )
        {{ $games->links('vendor.pagination.gamelist') }}
    @endif
</table>