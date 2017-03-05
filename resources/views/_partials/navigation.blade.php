<nav id="{{ $part }}">
    <ul>
        <li><a href="{{ url('/') }}">{{ trans('app.home.title') }}</a></li>
        <li><a href="{{ url('news') }}">{{ trans('app.news.title') }}</a></li>
        <li><a href="{{ url('games') }}">{{ trans('app.games.title') }}</a></li>
        <li><a href="{{ url('resources') }}">{{ trans('app.resources.title') }}</a></li>
        <li><a href="{{ url('developer') }}">{{ trans('app.developer.title') }}</a></li>
        <li><a href="{{ url('makers') }}">maker</a></li>
        <li><a href="{{ url('awards') }}">{{ trans('app.awards.title') }}</a></li>
        <li><a href="{{ url('users') }}">{{ trans('app.user.title') }}</a></li>
        <li><a href="{{ url('search') }}">{{ trans('app.search.title') }}</a></li>
        <li><a href="{{ url('board') }}">{{ trans('app.board.title') }}</a></li>
        <li><a href="{{ url('faq') }}">{{ trans('app.faq.title') }}</a></li>
        <li><a href="{{ url('submit') }}">{{ trans('app.submit.title') }}</a></li>
        @if($part == 'toppart')
            @if(Auth::check())
                @if(\Auth::user()->newThreadsCount() >= 1)
                    <li><a class="adminlink" href='{{ url('messages') }}'>neue nachricht(en)</a></li>
                @endif
                <li><a class="adminlink" href="{{ url('logout') }}">{{ trans('app.auth.logout') }}</a></li>
            @else
                <li><a class="adminlink" href="{{ url('login') }}">{{ trans('app.auth.login') }}</a></li>
            @endif
        @endif
    </ul>
</nav>