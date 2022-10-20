<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            @if($games instanceof \Illuminate\Pagination\LengthAwarePaginator )
                {{ $games->links('vendor.pagination.bootstrap-4') }}
            @endif
        </div>
        <ul class="list-group">
            @include('_partials.tables.game_table_head', ['games' => $games, 'orderby' => $orderby, 'direction' => $direction])

            @php
                $maxviews = \App\Helpers\DatabaseHelper::getGameViewsMax()
            @endphp

            @foreach($games as $game)
                @include('_partials.tables.game_table_row', ['game' => $game, 'maxviews' => $maxviews])
            @endforeach
        </ul>
        <div class="card-footer">
            @if($games instanceof \Illuminate\Pagination\LengthAwarePaginator )
                {{ $games->links('vendor.pagination.bootstrap-4') }}
            @endif
        </div>
    </div>
</div>