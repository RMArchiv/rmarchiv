@php
    $action = Route::currentRouteAction();
    $action = str_replace("App\\Http\\Controllers\\", '', $action);
@endphp


<li class="list-group-item action">
    <span class="text-capitalize">{{trans('app.sort.order_by')}}:</span>
        @if($orderby == 'title')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'title', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
                @elseif(isset($term))
                    <a class="activated"
                       href="{{ action($action, ['title', 'desc', $term]) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['title', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'title', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
                @elseif(isset($term))
                    <a class="activated"
                       href="{{ action($action, ['title', 'asc', $term]) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['title', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
            <a class="" href="{{ action($action, [$id, 'title', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
            @elseif(isset($term))
                <a class=""
                   href="{{ action($action, ['title', 'asc', $term]) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
            @else
            <a class="" href="{{ action($action, ['title', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.title') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'developer.name')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'developer.name', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.developer') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['developer.name', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.developer') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'developer.name', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.developer') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['developer.name', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.developer') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'developer.name', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.developer') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['developer.name', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.developer') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'release_date')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'release_date', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.release_date') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['release_date', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.release_date') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'release_date', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.release_date') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['release_date', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.release_date') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'release_date', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.release_date') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['release_date', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.release_date') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'created_at')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'created_at', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.created_at') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['created_at', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.created_at') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'created_at', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.created_at') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['created_at', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.created_at') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'created_at', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.created_at') }}</a>
            @else
                <a class=""
                   href="{{ action($action, ['created_at', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.created_at') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'voteup')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated" href="{{ action($action, [$id, 'voteup', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/></a>
                @else
                    <a class="activated" href="{{ action($action, ['voteup', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}"><img src='/assets/rate_up.gif'
                                                                                               alt='{{ trans('app.rate_up') }}'/></a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse" href="{{ action($action, [$id, 'voteup', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/></a>
                @else
                    <a class="activated reverse" href="{{ action($action, ['voteup', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}"><img
                                src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/></a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'voteup', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}"><img src='/assets/rate_up.gif'
                                                                                      alt='{{ trans('app.rate_up') }}'/></a>
            @else
                <a class="" href="{{ action($action, ['voteup', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}"><img src='/assets/rate_up.gif'
                                                                                 alt='{{ trans('app.rate_up') }}'/></a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'votedown')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated" href="{{ action($action, [$id, 'votedown', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/></a>
                @else
                    <a class="activated" href="{{ action($action, ['votedown', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/></a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse" href="{{ action($action, [$id, 'votedown', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/></a>
                @else
                    <a class="activated reverse" href="{{ action($action, ['votedown', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}"><img
                                src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/></a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class="" href="{{ action($action, [$id, 'votedown', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}"><img src='/assets/rate_down.gif'
                                                                                        alt='{{ trans('app.rate_down') }}'/></a>
            @else
                <a class="" href="{{ action($action, ['votedown', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}"><img src='/assets/rate_down.gif'
                                                                                   alt='{{ trans('app.rate_down') }}'/></a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'avg')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'avg', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.avg') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['avg', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.avg') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'avg', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.avg') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['avg', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.avg') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
            <a class="" href="{{ action($action, [$id, 'avg', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.avg') }}</a>
            @else
            <a class="" href="{{ action($action, ['avg', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.avg') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'views')
            @if($direction == 'asc')
                @if(isset($id))
                    <a class="activated"
                       href="{{ action($action, [$id, 'views', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.popularity') }}</a>
                @else
                    <a class="activated"
                       href="{{ action($action, ['views', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.popularity') }}</a>
                @endif
            @else
                @if(isset($id))
                    <a class="activated reverse"
                       href="{{ action($action, [$id, 'views', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.popularity') }}</a>
                @else
                    <a class="activated reverse"
                       href="{{ action($action, ['views', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.popularity') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
                <a class=""
                   href="{{ action($action, [$id, 'views', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.popularity') }}</a>
            @else
            <a class="" href="{{ action($action, ['views', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.popularity') }}</a>
            @endif
        @endif
            <span> • </span>
        @if($orderby == 'comments')
            @if($direction == 'asc')
                @if(isset($id))
                <a class="activated" href="{{ action($action, [$id, 'comments', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.comments') }}</a>
                @else
                <a class="activated" href="{{ action($action, ['comments', 'desc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.comments') }}</a>
                @endif
            @else
                @if(isset($id))
                <a class="activated reverse" href="{{ action($action, [$id, 'comments', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.comments') }}</a>
                @else
                <a class="activated reverse" href="{{ action($action, ['comments', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.comments') }}</a>
                @endif
            @endif
        @else
            @if(isset($id))
            <a class="" href="{{ action($action, [$id, 'comments', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.comments') }}</a>
            @else
            <a class="" href="{{ action($action, ['comments', 'asc']) . App\Helpers\MiscHelper::getQueryString() }}">{{ trans('app.comments') }}</a>
            @endif
        @endif

</li>