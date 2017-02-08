<table class='boxtable' id='rmarchivbox_stats'>
    <tr>
        <th class='header'><a href="{{ url('stats') }}">some stats</a></th>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->gamecount, 0, ',', '.') }} <a href='{{ url('games') }}'>spiele</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->makercount, 0, ',', '.') }} unterstützte maker
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->developercount, 0, ',', '.') }} <a href="{{ url('developer') }}">entwickler</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->usercount, 0, ',', '.') }} <a href='{{ url('users') }}'>user</a> - <a href="{{ url('users/activity') }}">aktivitäten</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->logocount, 0, ',', '.') }} <a href='{{ url('logo/vote') }}'>logos</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->threadcount, 0, ',', '.') }} <a href='{{ url('board') }}'>board threads</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->postcount, 0, ',', '.') }} <a href='{{ url('board') }}'>board posts</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->shoutboxcount, 0, ',', '.') }} <a href='{{ url('shoutbox') }}'>shouts</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->commentcount, 0, ',', '.') }} kommentare
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->filecount, 0, ',', '.') }} spieledateien
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ \App\Helpers\MiscHelper::getReadableBytes($stats->totalsize) }} gesamtgröße der dateien
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ number_format($stats->downloadcount, 0, ',', '.') }} downloads
        </td>
    </tr>
    <tr>
        <td class='r1'>
            {{ $size }} downloadtraffic
        </td>
    </tr>
</table>