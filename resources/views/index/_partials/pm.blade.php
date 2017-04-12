<table class='boxtable' id='rmarchivbox_pm'>
    <tr>
        <th class='header'>{{ trans('index.pm.title') }}</th>
    </tr>
    <tr>
        <td class='r1'>
            <a href='{{ url('messages') }}'>{{trans('index.pm.unreaded')}}: {{$pm or 0}}</a>
        </td>
    </tr>
    <tr>
        <td class='r1'>
            <a href="{{ url('messages/create') }}">{{ trans('index.pm.new_pm') }}</a>
        </td>
    </tr>
</table>
