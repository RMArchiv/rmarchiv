
<div class="panel panel-default">
    <div class="panel-heading">
        @if($games instanceof \Illuminate\Pagination\LengthAwarePaginator )
            {{ $games->links('vendor.pagination.bootstrap-4') }}
        @endif
    </div>
    <table class='table table-striped table-hover'>
        @include('_partials.tables.game_table_head', ['games' => $games, 'orderby' => $orderby, 'direction' => $direction])

        @php
            $maxviews = \App\Helpers\DatabaseHelper::getGameViewsMax()
        @endphp

        @foreach($games as $game)
            @include('_partials.tables.game_table_row', ['game' => $game, 'maxviews' => $maxviews])
        @endforeach
    </table>
    <div class="panel-footer">
        @if($games instanceof \Illuminate\Pagination\LengthAwarePaginator )
            {{ $games->links('vendor.pagination.bootstrap-4') }}
        @endif
    </div>
</div>

