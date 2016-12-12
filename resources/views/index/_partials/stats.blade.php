<table class='boxtable' id='rmarchivbox_stats'>
    <tr>
        <th class='header'>some stats</th>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->gamecount }} <a href='{{ url('games') }}'>spiele</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->makercount }} unterstützte maker
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->developercount }} <a href="{{ url('developer') }}">entwickler</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->usercount }} <a href='{{ url('users') }}'>user</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->logocount }} <a href='{{ url('logo/vote') }}'>logos</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->threadcount }} <a href='{{ url('board') }}'>board threads</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->postcount }} <a href='{{ url('board') }}'>board posts</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->shoutboxcount }} <a href='{{ url('shoutbox') }}'>shouts</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->commentcount }} kommentare
        </td>
    </tr>
</table>