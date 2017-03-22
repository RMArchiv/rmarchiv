<table class="inline_game_box">
    <tr>
        <td colspan="2">
            <a href="{{ route('games.show', $game->id) }}"><big>{{ $game->title }}</big>@if($game->subtitle) :: {{ $game->subtitle }}@endif</a>
        </td>
    </tr>
    <tr>
        <td>
            <img src='{{ route('screenshot.show', [$game->id, 1]) }}' alt='Titelbild' title='Titelbild' style="width: 160px;"/>
        </td>
        <td>
            Entwickler:
            @foreach($game->developers as $dev)
                <a href="{{ url('developer',$dev->developer_id) }}">{{ $dev->developer->name }}</a>
                @if($dev != $game->developers->last())
                    ::
                @endif
            @endforeach
            <br>
            {!! substr($game->desc_md, 0, 320).'...' !!}
        </td>
    </tr>
</table>