<div class='rmarchivtbl' id='rmarchivbox_latestbbs'>
    <h2>die 10 neuesten und fluffigsten threads</h2>
    <table class='boxtable'>
        @foreach($threads as $t)
        <tr class=''>
            <td>
                <a href='{{ url('users', $t->uid) }}' class='usera' title="{{ $t->uname }}">
                    <img src='http://ava.rmarchiv.de/?gender=male&id={{ $t->uid }}' alt="{{ $t->uname }}" class='avatar'/>
                </a>
                <a href='{{ url('users', $t->uid) }}' class='usera' title="{{ $t->uname }}">{{ $t->uname }}</a>
            </td>
            <td class='category'><a href="{{ route('board.cat.show', $t->cid) }}">{{ $t->ctitle }}</a></td>
            <td class='topic'>
                <a href='{{ route('board.thread.show', $t->tid) }}'>{{ $t->ttitle }}</a>
            </td>
            <td class='count' title=''>{{ $t->pcount  }}</td>
            <td>
                <a href='{{ url('users', $t->luid) }}' class='usera' title="{{ $t->luname }}">
                    <img src='http://ava.rmarchiv.de/?gender=&id={{ $t->luid }}' alt="{{ $t->luname }}" class='avatar'/>
                </a>
                <a href='{{ url('users', $t->luid) }}' class='usera' title="{{ $t->luname }}">{{ $t->luname }}</a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class='foot'><a href='{{ route('board.show') }}'>more</a>...</div>
</div>