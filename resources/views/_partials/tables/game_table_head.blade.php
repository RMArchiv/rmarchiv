@php
    $action = Route::currentRouteAction();
    $action = str_replace("App\\Http\\Controllers\\", '', $action);
@endphp

<thead>
    <tr class='sortable'>
        <th>
            @if($orderby == 'title')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'title', 'desc']) }}">spielname</a>
                    @elseif(isset($term))
                        <a class="activated" href="{{ action($action, ['title', 'desc', $term]) }}">spielname</a>
                    @else
                        <a class="activated" href="{{ action($action, ['title', 'desc']) }}">spielname</a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'title', 'asc']) }}">spielname</a>
                    @elseif(isset($term))
                        <a class="activated" href="{{ action($action, ['title', 'asc', $term]) }}">spielname</a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['title', 'asc']) }}">spielname</a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'title', 'asc']) }}">spielname</a>
                @elseif(isset($term))
                    <a class="" href="{{ action($action, ['title', 'asc', $term]) }}">spielname</a>
                @else
                    <a class="" href="{{ action($action, ['title', 'asc']) }}">spielname</a>
                @endif
            @endif
        </th>
        <th>
            @if($orderby == 'developer.name')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'developer.name', 'desc']) }}">entwickler</a>
                    @else
                        <a class="activated" href="{{ action($action, ['developer.name', 'desc']) }}">entwickler</a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'developer.name', 'asc']) }}">entwickler</a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['developer.name', 'asc']) }}">entwickler</a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'developer.name', 'asc']) }}">entwickler</a>
                @else
                    <a class="" href="{{ action($action, ['developer.name', 'asc']) }}">entwickler</a>
                @endif
            @endif
        </th>
        <th>
            @if($orderby == 'release_date')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'release_date', 'desc']) }}">release datum</a>
                    @else
                        <a class="activated" href="{{ action($action, ['release_date', 'desc']) }}">release datum</a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'release_date', 'asc']) }}">release datum</a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['release_date', 'asc']) }}">release datum</a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'release_date', 'asc']) }}">release datum</a>
                @else
                    <a class="" href="{{ action($action, ['release_date', 'asc']) }}">release datum</a>
                @endif
            @endif
        </th>
        <th>
            @if($orderby == 'created_at')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'created_at', 'desc']) }}">hinzugefügt</a>
                    @else
                        <a class="activated" href="{{ action($action, ['created_at', 'desc']) }}">hinzugefügt</a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'created_at', 'asc']) }}">hinzugefügt</a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['created_at', 'asc']) }}">hinzugefügt</a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'created_at', 'asc']) }}">hinzugefügt</a>
                @else
                    <a class="" href="{{ action($action, ['created_at', 'asc']) }}">hinzugefügt</a>
                @endif
            @endif
        </th>
        <th>
            @if($orderby == 'voteup')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'voteup', 'desc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                    @else
                        <a class="activated" href="{{ action($action, ['voteup', 'desc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'voteup', 'asc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['voteup', 'asc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'voteup', 'asc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                @else
                    <a class="" href="{{ action($action, ['voteup', 'asc']) }}"><img src='/assets/rate_up.gif' alt='super' /></a>
                @endif
            @endif
        </th>
        <th>
            @if($orderby == 'votedown')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'votedown', 'desc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                    @else
                        <a class="activated" href="{{ action($action, ['votedown', 'desc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'votedown', 'asc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['votedown', 'asc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'votedown', 'asc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                @else
                    <a class="" href="{{ action($action, ['votedown', 'asc']) }}"><img src='/assets/rate_down.gif' alt='scheiße' /></a>
                @endif
            @endif
        </th>
        <th>
            @if($orderby == 'avg')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'avg', 'desc']) }}">avg</a>
                    @else
                        <a class="activated" href="{{ action($action, ['avg', 'desc']) }}">avg</a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'avg', 'asc']) }}">avg</a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['avg', 'asc']) }}">avg</a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'avg', 'asc']) }}">avg</a>
                @else
                    <a class="" href="{{ action($action, ['avg', 'asc']) }}">avg</a>
                @endif
            @endif
        </th>
        <th>
            @if($orderby == 'views')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'views', 'desc']) }}">popularität</a>
                    @else
                        <a class="activated" href="{{ action($action, ['views', 'desc']) }}">popularität</a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'views', 'asc']) }}">popularität</a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['views', 'asc']) }}">popularität</a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'views', 'asc']) }}">popularität</a>
                @else
                    <a class="" href="{{ action($action, ['views', 'asc']) }}">popularität</a>
                @endif
            @endif
        </th>
        <th>
            @if($orderby == 'comments')
                @if($direction == 'asc')
                    @if(isset($id))
                        <a class="activated" href="{{ action($action, [$id, 'comments', 'desc']) }}">kommentare</a>
                    @else
                        <a class="activated" href="{{ action($action, ['comments', 'desc']) }}">kommentare</a>
                    @endif
                @else
                    @if(isset($id))
                        <a class="activated reverse" href="{{ action($action, [$id, 'comments', 'asc']) }}">kommentare</a>
                    @else
                        <a class="activated reverse" href="{{ action($action, ['comments', 'asc']) }}">kommentare</a>
                    @endif
                @endif
            @else
                @if(isset($id))
                    <a class="" href="{{ action($action, [$id, 'comments', 'asc']) }}">kommentare</a>
                @else
                    <a class="" href="{{ action($action, ['comments', 'asc']) }}">kommentare</a>
                @endif
            @endif
        </th>
    </tr>
</thead>