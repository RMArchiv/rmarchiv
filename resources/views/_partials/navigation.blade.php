<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" data-vivaldi-spatnav-clickable="1">rmarchiv.de</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">{{ trans('index.title') }}</a></li>
                <li><a href="{{ url('news') }}">{{ trans('news.title') }}</a></li>
                <li><a href="{{ url('games') }}">{{ trans('games.title') }}</a></li>
                <li><a href="{{ url('resources') }}">{{ trans('resources.title') }}</a></li>
                <li><a href="{{ url('developer') }}">{{ trans('developer.title') }}</a></li>
                <li><a href="{{ url('makers') }}">{{ trans('maker.title') }}</a></li>
                <li><a href="{{ url('awards') }}">{{ trans('awards.title') }}</a></li>
                <li><a href="{{ url('users') }}">{{ trans('user.title') }}</a></li>
                <li><a href="{{ url('search') }}">{{ trans('search.title') }}</a></li>
                <li><a href="{{ url('board') }}">{{ trans('board.title') }}</a></li>
                <li><a href="{{ url('faq') }}">{{ trans('faq.title') }}</a></li>
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                       data-vivaldi-spatnav-clickable="1">
                        {{ trans('submit.title') }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href='{{ url('games/create') }}'>einsenden eines spiels</a></li>
                        <li><a href='{{ url('resources/create') }}'>einsenden von ressourcen</a></li>
                        <li><a href='{{ url('news/create') }}'>einsenden von news</a></li>
                        <li><a href='{{ url('submit/logo') }}'>upload eines logos</a></li>
                        <li><a href='{{ url('logo/vote') }}'>bewerte logos</a></li>
                        <li class="divider"></li>
                        <li><a href='{{ url('missing/gamescreens') }}'>fehlende spielescreenshots</a></li>
                        <li><a href='{{ url('missing/gamefiles') }}'>fehlende spieledateien</a></li>
                        <li><a href='{{ url('missing/gamedesc') }}'>fehlende spielebeschreibungen</a></li>
                        <li><a href='{{ url('missing/notags') }}'>ohne tags</a></li>
                        <div class="divider"></div>
                        @permission(('admin-user'))
                        <li><a href="{{ url('users/perm/role') }}">benutzerberechtigungen</a></li>
                        @endpermission
                        @permission(('admin-board'))
                        <li><a href="{{ url('board/create') }}">board kategorie hinzufügen</a></li>
                        @endpermission
                        @permission(('admin-cdc'))
                        <li><a href="{{ url('cdc/create') }}">'coup de coeur' hinzufügen</a></li>
                        @endpermission
                        @permission(('create-faq'))
                        <li><a href="{{ url('faq/create') }}">faq hinzufügen</a></li>
                        @endpermission
                        @permission(('create-awards'))
                        <li><a href="{{ url('awards/create') }}">award-kategorie hinzufügen</a></li>
                        @endpermission
                        @permission(('admin-comments'))
                        <li><a href="{{ url('reported/comments') }}">gemeldete kommentare</a></li>
                        @endpermission
                    </ul>
                </li>
                @endif
            </ul>
            {{ Form::open(['action' => ['SearchController@search'], 'class' => 'navbar-form navbar-right']) }}
                <div class="form-group">
                    <input type="text" class="form-control" id="term" name="term" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>

                <script type="text/javascript">
                    var sourcepath = new Bloodhound({
                        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                        queryTokenizer: Bloodhound.tokenizers.whitespace,
                        //prefetch: '../data/films/post_1960.json',
                        remote: {
                            url: '/ac_search/%QUERY',
                            wildcard: '%QUERY'
                        }
                    });

                    $('#term').typeahead(null, {
                        name: 'term',
                        display: 'title',
                        source: sourcepath,
                        limit: 5,
                        templates: {
                            empty: [
                                '<div class="empty-message">',
                                '{{ trans('index.search.not_found') }}',
                                '</div>'
                            ].join('\n'),
                            suggestion: function(data) {
                                console.log(data);
                                return data.value;
                            }
                        },
                        classNames: {
                            menu: 'search_menu',
                        }
                    });
                </script>
            {{ Form::close() }}

            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                           data-vivaldi-spatnav-clickable="1">
                            hallo, {{ Auth::user()->name }} <span class="caret"></span>
                            @if(\Auth::user()->newThreadsCount() >= 1)
                                <span class="badge">{{ \Auth::user()->newThreadsCount() }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ action('MessagesController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('index.pm.unreaded') }} <span class="badge">{{\Auth::user()->newThreadsCount()}}</span></a></li>
                            <li><a href="{{ action('MessagesController@create') }}" data-vivaldi-spatnav-clickable="1">{{ trans('index.pm.new_pm') }}</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ action('UserSettingsController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('index.logout.settings') }}</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ action('Auth\LoginController@logout') }}" data-vivaldi-spatnav-clickable="1">{{ trans('index.logout.logout') }}</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ action('Auth\LoginController@showLoginForm') }}">{{ trans('index.login.login') }}</a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>