<table class='boxtable' id='rmarchivbox_pm'>
    <tr>
        <th class='header'>nachrichten</th>
    </tr>
    <tr>
        <td class='r1'>
            <a href='{{ url('messages') }}'>ungelesen: {{$pm or 0}}</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            <a href="{{ url('messages/create') }}">neue nachricht</a>
        </td>
    </tr>
</table>
