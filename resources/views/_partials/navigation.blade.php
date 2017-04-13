<nav id="{{ $part }}">
    <ul>
        <li><a href="{{ url('/') }}">{{ trans('index.title') }}</a></li>
        <li><a href="{{ url('news') }}">{{ trans('news.title') }}</a></li>
        <li><a href="{{ url('games') }}">{{ trans('games.title') }}</a></li>
        <li><a href="{{ url('resources') }}">{{ trans('resources.title') }}</a></li>
        <li><a href="{{ url('developer') }}">{{ trans('developer.title') }}</a></li>
        <li><a href="{{ url('makers') }}">{{ trans('app.maker.title') }}</a></li>
        <li><a href="{{ url('awards') }}">{{ trans('app.awards.title') }}</a></li>
        <li><a href="{{ url('users') }}">{{ trans('app.user.title') }}</a></li>
        <li><a href="{{ url('search') }}">{{ trans('app.search.title') }}</a></li>
        <li><a href="{{ url('board') }}">{{ trans('board.title') }}</a></li>
        <li><a href="{{ url('faq') }}">{{ trans('app.faq.title') }}</a></li>
        <li><a href="{{ url('submit') }}">{{ trans('app.submit.title') }}</a></li>
        @if($part == 'toppart')
            @if(Auth::check())
                @if(\Auth::user()->newThreadsCount() >= 1)
                    <li><a class="adminlink" href='{{ url('messages') }}'>{{ trans('app.messages.new_msg') }}</a></li>
                @endif
                <li><a class="adminlink" href="{{ url('logout') }}">{{ trans('auth.logout') }}</a></li>
            @else
                <li><a class="adminlink" href="{{ url('login') }}">{{ trans('auth.login') }}</a></li>
            @endif
        @endif
    </ul>
</nav>