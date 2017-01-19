<table class='boxtable' id='rmarchivbox_stats'>
    <tr>
        <th class='header'><a href="{{ url('stats') }}">some stats</a></th>
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
            {{ $stats->usercount }} <a href='{{ url('users') }}'>user</a> - <a href="{{ url('users/activity') }}">aktivitäten</a>
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
    <tr>
        <td class='r1'>
            {{ $stats->filecount }} spieledateien
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ \App\Helpers\MiscHelper::getReadableBytes($stats->totalsize) }} gesamtgröße der dateien
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $stats->downloadcount }} downloads
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $size }} downloadtraffic
        </td>
    </tr>
</table>