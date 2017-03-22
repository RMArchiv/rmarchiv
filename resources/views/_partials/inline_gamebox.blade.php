<div class="inlinebox_game">
    <div class="game_screen">
        <img src='{{ route('screenshot.show', [$game->id, 1]) }}' alt='Titelbild' title='Titelbild'/>
    </div>
    <div class="game_info">
        <div class="game_title">
            <a href="{{ route('games.show', $game->id) }}"><big>{{ $game->title }}</big>@if($game->subtitle) :: {{ $game->subtitle }}@endif</a>
        </div>
        <div class="game_dev">
            @foreach($game->developers as $dev)
                <a href="{{ url('developer',$dev->developer_id) }}">{{ $dev->developer->name }}</a>
                @if($dev != $game->developers->last())
                    ::
                @endif
            @endforeach
        </div>
        <div class="game_desc">
            zusammenfassung (die ersten zeichen)
        </div>
    </div>
</div>