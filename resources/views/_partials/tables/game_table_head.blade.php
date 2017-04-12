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
                    <a class="activated"
                       href="{{ action($action, [$id, 'title', 'desc']) }}">{{ trans('app.games.table.title') }}</a>
                @elseif(isset($term))
                    <a class="activated"
                       href="{{ action($action, ['title', 'desc', $term]) }}">{{ trans('app.games.table.title') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['title', 'desc']) }}">{{ trans('app.games.table.title') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'title', 'asc']) }}">{{ trans('app.games.table.title') }}</a>
                @elseif(isset($term))
                    <a class="activated"
                       href="{{ action($action, ['title', 'asc', $term]) }}">{{ trans('app.games.table.title') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['title', 'asc']) }}">{{ trans('app.games.table.title') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'title', 'asc']) }}">{{ trans('app.games.table.title') }}</a>
            @elseif(isset($term))
                <a class=""
                   href="{{ action($action, ['title', 'asc', $term]) }}">{{ trans('app.games.table.title') }}</a>
            @else
                <a class="" href="{{ action($action, ['title', 'asc']) }}">{{ trans('app.games.table.title') }}</a>
            @endif
        @endif
    </th>
    <th>
        @if($orderby == 'developer.name')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'developer.name', 'desc']) }}">{{ trans('app.games.table.developer') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['developer.name', 'desc']) }}">{{ trans('app.games.table.developer') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'developer.name', 'asc']) }}">{{ trans('app.games.table.developer') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['developer.name', 'asc']) }}">{{ trans('app.games.table.developer') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'developer.name', 'asc']) }}">{{ trans('app.games.table.developer') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['developer.name', 'asc']) }}">{{ trans('app.games.table.developer') }}</a>
            @endif
        @endif
    </th>
    <th>
        @if($orderby == 'release_date')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'release_date', 'desc']) }}">{{ trans('app.games.table.release_date') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['release_date', 'desc']) }}">{{ trans('app.games.table.release_date') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'release_date', 'asc']) }}">{{ trans('app.games.table.release_date') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['release_date', 'asc']) }}">{{ trans('app.games.table.release_date') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'release_date', 'asc']) }}">{{ trans('app.games.table.release_date') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['release_date', 'asc']) }}">{{ trans('app.games.table.release_date') }}</a>
            @endif
        @endif
    </th>
    <th>
        @if($orderby == 'created_at')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'created_at', 'desc']) }}">{{ trans('app.games.table.created_at') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['created_at', 'desc']) }}">{{ trans('app.games.table.created_at') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'created_at', 'asc']) }}">{{ trans('app.games.table.created_at') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['created_at', 'asc']) }}">{{ trans('app.games.table.created_at') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'created_at', 'asc']) }}">{{ trans('app.games.table.created_at') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['created_at', 'asc']) }}">{{ trans('app.games.table.created_at') }}</a>
            @endif
        @endif
    </th>
    <th>
        @if($orderby == 'voteup')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated" href="{{ action($action, [$id, 'voteup', 'desc']) }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('app.games.table.rate_up') }}'/></a>
                @else
                    <a class="activated" href="{{ action($action, ['voteup', 'desc']) }}"><img src='/assets/rate_up.gif'
                                                                                               alt='{{ trans('app.games.table.rate_up') }}'/></a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse" href="{{ action($action, [$id, 'voteup', 'asc']) }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('app.games.table.rate_up') }}'/></a>
                @else
                    <a class="activated reverse" href="{{ action($action, ['voteup', 'asc']) }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('app.games.table.rate_up') }}'/></a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'voteup', 'asc']) }}"><img src='/assets/rate_up.gif'
                                                                                      alt='{{ trans('app.games.table.rate_up') }}'/></a>
            @else
                <a class="" href="{{ action($action, ['voteup', 'asc']) }}"><img src='/assets/rate_up.gif'
                                                                                 alt='{{ trans('app.games.table.rate_up') }}'/></a>
            @endif
        @endif
    </th>
    <th>
        @if($orderby == 'votedown')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated" href="{{ action($action, [$id, 'votedown', 'desc']) }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('app.games.table.rate_down') }}'/></a>
                @else
                    <a class="activated" href="{{ action($action, ['votedown', 'desc']) }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('app.games.table.rate_down') }}'/></a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse" href="{{ action($action, [$id, 'votedown', 'asc']) }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('app.games.table.rate_down') }}'/></a>
                @else
                    <a class="activated reverse" href="{{ action($action, ['votedown', 'asc']) }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('app.games.table.rate_down') }}'/></a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'votedown', 'asc']) }}"><img src='/assets/rate_down.gif'
                                                                                        alt='{{ trans('app.games.table.rate_down') }}'/></a>
            @else
                <a class="" href="{{ action($action, ['votedown', 'asc']) }}"><img src='/assets/rate_down.gif'
                                                                                   alt='{{ trans('app.games.table.rate_down') }}'/></a>
            @endif
        @endif
    </th>
    <th>
        @if($orderby == 'avg')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'avg', 'desc']) }}">{{ trans('app.games.table.avg') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['avg', 'desc']) }}">{{ trans('app.games.table.avg') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'avg', 'asc']) }}">{{ trans('app.games.table.avg') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['avg', 'asc']) }}">{{ trans('app.games.table.avg') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'avg', 'asc']) }}">{{ trans('app.games.table.avg') }}</a>
            @else
                <a class="" href="{{ action($action, ['avg', 'asc']) }}">{{ trans('app.games.table.avg') }}</a>
            @endif
        @endif
    </th>
    <th>
        @if($orderby == 'views')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'views', 'desc']) }}">{{ trans('app.games.table.popularity') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['views', 'desc']) }}">{{ trans('app.games.table.popularity') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'views', 'asc']) }}">{{ trans('app.games.table.popularity') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['views', 'asc']) }}">{{ trans('app.games.table.popularity') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'views', 'asc']) }}">{{ trans('app.games.table.popularity') }}</a>
            @else
                <a class="" href="{{ action($action, ['views', 'asc']) }}">{{ trans('app.games.table.popularity') }}</a>
            @endif
        @endif
    </th>
    <th>
        @if($orderby == 'comments')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated" href="{{ action($action, [$id, 'comments', 'desc']) }}">{{ trans('app.games.table.comments') }}</a>
                @else
                    <a class="activated" href="{{ action($action, ['comments', 'desc']) }}">{{ trans('app.games.table.comments') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse" href="{{ action($action, [$id, 'comments', 'asc']) }}">{{ trans('app.games.table.comments') }}</a>
                @else
                    <a class="activated reverse" href="{{ action($action, ['comments', 'asc']) }}">{{ trans('app.games.table.comments') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'comments', 'asc']) }}">{{ trans('app.games.table.comments') }}</a>
            @else
                <a class="" href="{{ action($action, ['comments', 'asc']) }}">{{ trans('app.games.table.comments') }}</a>
            @endif
        @endif
    </th>
</tr>
</thead>