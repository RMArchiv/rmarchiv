<div class='rmarchivtbl' id='rmarchivbox_latestbbs'>
    <h2>die 10 neuesten und fluffigsten threads</h2>
    <table class='boxtable'>
        @foreach($threads as $t)
        <tr class=''>
            <td>
                <a href='{{ url('users', $t->usercreateid) }}' class='usera' title="{{ $t->usercreatename }}">
                    <img src='http://ava.rmarchiv.de/?gender=male&id={{ $t->usercreateid }}' alt="{{ $t->usercreatename }}" class='avatar'/>
                </a>
                <a href='{{ url('users', $t->usercreateid) }}' class='usera' title="{{ $t->usercreatename }}">{{ $t->usercreatename }}</a>
            </td>
            <td class='category'><a href="{{ route('board.cat.show', $t->catid) }}">{{ $t->cattitle }}</a></td>
            <td class='topic'>
                <a href='{{ route('board.thread.show', $t->threadid) }}'>
                    @if($t->threadclosed == 1)
                        <img src="/assets/lock.png">
                    @endif
                    {{ $t->threadtitle }}</a>
            </td>
            <td class='count' title=''>{{ $t->posts  }}</td>
            <td>
                <a href='{{ url('users', $t->userlastid) }}' class='usera' title="{{ $t->userlastname }}">
                    <img src='http://ava.rmarchiv.de/?gender=&id={{ $t->userlastid }}' alt="{{ $t->userlastname }}" class='avatar'/>
                </a>
                <a href='{{ url('users', $t->userlastid) }}' class='usera' title="{{ $t->userlastname }}">{{ $t->userlastname }}</a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class='foot'><a href='{{ route('board.show') }}'>more</a>...</div>
</div>