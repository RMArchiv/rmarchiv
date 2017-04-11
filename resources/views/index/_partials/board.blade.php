<div class='rmarchivtbl' id='rmarchivbox_latestbbs'>
    <h2>die 10 neuesten und fluffigsten threads</h2>
    <table class='boxtable'>
        @foreach($threads as $t)
        <tr class='' @if(\App\Helpers\DatabaseHelper::isThreadUnread($t->id) === true) style="font-weight: bold;" @endif>
            <td>
                <a href='{{ url('users', $t->user->id) }}' class='usera' title="{{ $t->user->name }}">
                    <img src='http://ava.rmarchiv.de/?gender=male&id={{ $t->user->id }}' alt="{{ $t->user->name }}" class='avatar'/>
                </a>
                <a href='{{ url('users', $t->user->id) }}' class='usera' title="{{ $t->user->name }}">{{ $t->user->name }}</a>
            </td>
            <td class='category'><a href="{{ route('board.cat.show', $t->cat->id) }}">{{ $t->cat->title }}</a></td>
            <td>
                <a href='{{ route('board.thread.show', $t->id) }}'>
                    @if($t->closed == 1)
                        <img src="/assets/lock.png">
                    @endif
                    @if(\App\Models\BoardPoll::whereThreadId($t->id)->count() != 0)
                        <img src="/assets/stats.gif">
                    @endif
                    {{ $t->title }}</a>
            </td>
            <td class='count' title=''>{{ $t->posts->count()  }}</td>
            <td>
                <a href='{{ url('users', $t->last_user->id) }}' class='usera' title="{{ $t->last_user->name }}">
                    <img src='http://ava.rmarchiv.de/?gender=&id={{ $t->last_user->id }}' alt="{{ $t->last_user->name }}" class='avatar'/>
                </a>
                <a href='{{ url('users', $t->last_user->id) }}' class='usera' title="{{ $t->last_user->name }}">{{ $t->last_user->name }}</a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class='foot'><a href='{{ route('board.show') }}'>more</a>...</div>
</div>