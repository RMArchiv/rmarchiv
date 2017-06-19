@php
    $action = Route::currentRouteAction();
    $action = str_replace("App\\Http\\Controllers\\", '', $action);
@endphp

<li class="list-group-item action">
    sortieren nach:
        @if($orderby == 'title')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'title', 'desc']) }}">{{ trans('app.title') }}</a>
                @elseif(isset($term))
                    <a class="activated"
                       href="{{ action($action, ['title', 'desc', $term]) }}">{{ trans('app.title') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['title', 'desc']) }}">{{ trans('app.title') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'title', 'asc']) }}">{{ trans('app.title') }}</a>
                @elseif(isset($term))
                    <a class="activated"
                       href="{{ action($action, ['title', 'asc', $term]) }}">{{ trans('app.title') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['title', 'asc']) }}">{{ trans('app.title') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
            <a class="" href="{{ action($action, [$id, 'title', 'asc']) }}">{{ trans('app.title') }}</a>
            @elseif(isset($term))
                <a class=""
                   href="{{ action($action, ['title', 'asc', $term]) }}">{{ trans('app.title') }}</a>
            @else
            <a class="" href="{{ action($action, ['title', 'asc']) }}">{{ trans('app.title') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'developer.name')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'developer.name', 'desc']) }}">{{ trans('app.developer') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['developer.name', 'desc']) }}">{{ trans('app.developer') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'developer.name', 'asc']) }}">{{ trans('app.developer') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['developer.name', 'asc']) }}">{{ trans('app.developer') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'developer.name', 'asc']) }}">{{ trans('app.developer') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['developer.name', 'asc']) }}">{{ trans('app.developer') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'release_date')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'release_date', 'desc']) }}">{{ trans('app.release_date') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['release_date', 'desc']) }}">{{ trans('app.release_date') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'release_date', 'asc']) }}">{{ trans('app.release_date') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['release_date', 'asc']) }}">{{ trans('app.release_date') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'release_date', 'asc']) }}">{{ trans('app.release_date') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['release_date', 'asc']) }}">{{ trans('app.release_date') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'created_at')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'created_at', 'desc']) }}">{{ trans('app.created_at') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['created_at', 'desc']) }}">{{ trans('app.created_at') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'created_at', 'asc']) }}">{{ trans('app.created_at') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['created_at', 'asc']) }}">{{ trans('app.created_at') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'created_at', 'asc']) }}">{{ trans('app.created_at') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['created_at', 'asc']) }}">{{ trans('app.created_at') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'voteup')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated" href="{{ action($action, [$id, 'voteup', 'desc']) }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('_partials.tables.game_table_head.rate_up') }}'/></a>
                @else
                    <a class="activated" href="{{ action($action, ['voteup', 'desc']) }}"><img src='/assets/rate_up.gif'
                                                                                               alt='{{ trans('_partials.tables.game_table_head.rate_up') }}'/></a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse" href="{{ action($action, [$id, 'voteup', 'asc']) }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('_partials.tables.game_table_head.rate_up') }}'/></a>
                @else
                    <a class="activated reverse" href="{{ action($action, ['voteup', 'asc']) }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('_partials.tables.game_table_head.rate_up') }}'/></a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'voteup', 'asc']) }}"><img src='/assets/rate_up.gif'
                                                                                      alt='{{ trans('_partials.tables.game_table_head.rate_up') }}'/></a>
            @else
                <a class="" href="{{ action($action, ['voteup', 'asc']) }}"><img src='/assets/rate_up.gif'
                                                                                 alt='{{ trans('_partials.tables.game_table_head.rate_up') }}'/></a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'votedown')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated" href="{{ action($action, [$id, 'votedown', 'desc']) }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('_partials.tables.game_table_head.rate_down') }}'/></a>
                @else
                    <a class="activated" href="{{ action($action, ['votedown', 'desc']) }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('_partials.tables.game_table_head.rate_down') }}'/></a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse" href="{{ action($action, [$id, 'votedown', 'asc']) }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('_partials.tables.game_table_head.rate_down') }}'/></a>
                @else
                    <a class="activated reverse" href="{{ action($action, ['votedown', 'asc']) }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('_partials.tables.game_table_head.rate_down') }}'/></a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'votedown', 'asc']) }}"><img src='/assets/rate_down.gif'
                                                                                        alt='{{ trans('_partials.tables.game_table_head.rate_down') }}'/></a>
            @else
                <a class="" href="{{ action($action, ['votedown', 'asc']) }}"><img src='/assets/rate_down.gif'
                                                                                   alt='{{ trans('_partials.tables.game_table_head.rate_down') }}'/></a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'avg')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'avg', 'desc']) }}">{{ trans('app.avg') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['avg', 'desc']) }}">{{ trans('app.avg') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'avg', 'asc']) }}">{{ trans('app.avg') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['avg', 'asc']) }}">{{ trans('app.avg') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
            <a class="" href="{{ action($action, [$id, 'avg', 'asc']) }}">{{ trans('app.avg') }}</a>
            @else
            <a class="" href="{{ action($action, ['avg', 'asc']) }}">{{ trans('app.avg') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'views')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'views', 'desc']) }}">{{ trans('app.popularity') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['views', 'desc']) }}">{{ trans('app.popularity') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'views', 'asc']) }}">{{ trans('app.popularity') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['views', 'asc']) }}">{{ trans('app.popularity') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'views', 'asc']) }}">{{ trans('app.popularity') }}</a>
            @else
            <a class="" href="{{ action($action, ['views', 'asc']) }}">{{ trans('app.popularity') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'comments')
            @if($direction == 'asc')
                @if(isset($id))
                <a class="activated" href="{{ action($action, [$id, 'comments', 'desc']) }}">{{ trans('app.comments') }}</a>
                @else
                <a class="activated" href="{{ action($action, ['comments', 'desc']) }}">{{ trans('app.comments') }}</a>
                @endif
            @else
                @if(isset($id))
                <a class="activated reverse" href="{{ action($action, [$id, 'comments', 'asc']) }}">{{ trans('app.comments') }}</a>
                @else
                <a class="activated reverse" href="{{ action($action, ['comments', 'asc']) }}">{{ trans('app.comments') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
            <a class="" href="{{ action($action, [$id, 'comments', 'asc']) }}">{{ trans('app.comments') }}</a>
            @else
            <a class="" href="{{ action($action, ['comments', 'asc']) }}">{{ trans('app.comments') }}</a>
            @endif
        @endif

</li>