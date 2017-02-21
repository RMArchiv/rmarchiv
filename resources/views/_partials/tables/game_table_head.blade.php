@php
    $action = Route::currentRouteAction();
    $action = str_replace("App\\Http\\Controllers\\", '', $action);
@endphp

<thead>
    <tr class='sortable'>
        <th>
            @if($orderby == 'title')
                @if($direction == 'asc')
                    <a class="activated" href="{{ action($action, ['title', 'desc']) }}">spielname</a>
                @else
                    <a class="activated reverse" href="{{ action($action, ['title', 'asc']) }}">spielname</a>
                @endif
            @else
                <a class="" href="{{ action($action, ['title', 'asc']) }}">spielname</a>
            @endif
        </th>
        <th>
            @if($orderby == 'developer.name')
            @if($direction == 'asc')
            <a class="activated" href="{{ action($action, ['developer.name', 'desc']) }}">entwickler</a>
            @else
            <a class="activated reverse" href="{{ action($action, ['developer.name', 'asc']) }}">entwickler</a>
            @endif
            @else
            <a class="" href="{{ action($action, ['developer.name', 'asc']) }}">entwickler</a>
            @endif
        </th>
        <th>
            @if($orderby == 'game.release_date')
            @if($direction == 'asc')
            <a class="activated" href="{{ action($action, ['game.release_date', 'desc']) }}">release date</a>
            @else
            <a class="activated reverse" href="{{ action($action, ['game.release_date', 'asc']) }}">release date</a>
            @endif
            @else
            <a class="" href="{{ action($action, ['game.release_date', 'asc']) }}">release date</a>
            @endif
        </th>
        <th>
            @if($orderby == 'created_at')
            @if($direction == 'asc')
            <a class="activated" href="{{ action($action, ['created_at', 'desc']) }}">hinzugefügt</a>
            @else
            <a class="activated reverse" href="{{ action($action, ['created_at', 'asc']) }}">hinzugefügt</a>
            @endif
            @else
            <a class="" href="{{ action($action, ['created_at', 'asc']) }}">hinzugefügt</a>
            @endif
        </th>
        <th>
            @if($orderby == 'voteup')
            @if($direction == 'asc')
            <a class="activated" href="{{ action($action, ['voteup', 'desc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
            @else
            <a class="activated reverse" href="{{ action($action, ['voteup', 'asc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
            @endif
            @else
            <a class="" href="{{ action($action, ['voteup', 'asc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
            @endif
        </th>
        <th>
            @if($orderby == 'votedown')
            @if($direction == 'asc')
            <a class="activated" href="{{ action($action, ['votedown', 'desc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
            @else
            <a class="activated reverse" href="{{ action($action, ['votedown', 'asc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
            @endif
            @else
            <a class="" href="{{ action($action, ['votedown', 'asc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
            @endif
        </th>
        <th>
            @if($orderby == 'avg')
            @if($direction == 'asc')
            <a class="activated" href="{{ action($action, ['avg', 'desc']) }}">avg</a>
            @else
            <a class="activated reverse" href="{{ action($action, ['avg', 'asc']) }}">avg</a>
            @endif
            @else
            <a class="" href="{{ action($action, ['avg', 'asc']) }}">avg</a>
            @endif
        </th>
        <th>
            @if($orderby == 'views')
            @if($direction == 'asc')
            <a class="activated" href="{{ action($action, ['views', 'desc']) }}">popularität</a>
            @else
            <a class="activated reverse" href="{{ action($action, ['views', 'asc']) }}">popularität</a>
            @endif
            @else
            <a class="" href="{{ action($action, ['views', 'asc']) }}">popularität</a>
            @endif
        </th>
        <th>
            @if($orderby == 'commentcount')
            @if($direction == 'asc')
            <a class="activated" href="{{ action($action, ['commentcount', 'desc']) }}">kommentare</a>
            @else
            <a class="activated reverse" href="{{ action($action, ['commentcount', 'asc']) }}">kommentare</a>
            @endif
            @else
            <a class="" href="{{ action($action, ['commentcount', 'asc']) }}">kommentare</a>
            @endif
        </th>
    </tr>
</thead>