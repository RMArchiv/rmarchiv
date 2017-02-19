<table id='rmarchiv_prodlist' class='boxtable pagedtable'>
    @include('_partials.tables.game_table_head')

    @foreach($games as $game)

    @endforeach
    @if($games instanceof \Illuminate\Pagination\LengthAwarePaginator )
        {{ $games->links('vendor.pagination.gamelist') }}
    @endif
</table>