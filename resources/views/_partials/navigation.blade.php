<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">{{ trans('app.toggle_navigation') }}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" data-vivaldi-spatnav-clickable="1">rmarchiv.de</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">{{ trans('app.home') }}</a></li>
                <li><a href="{{ url('news') }}">{{ trans('app.news') }}</a></li>
                <li><a href="{{ url('games') }}">{{ trans('app.games') }}</a></li>
                <li><a href="{{ url('resources') }}">{{ trans('app.resources') }}</a></li>
                <li><a href="{{ url('developer') }}">{{ trans('app.developers') }}</a></li>
                <li><a href="{{ url('makers') }}">{{ trans('app.makers') }}</a></li>
                <li><a href="{{ url('awards') }}">{{ trans('app.awards') }}</a></li>
                <li><a href="{{ url('users') }}">{{ trans('app.users') }}</a></li>
                <li><a href="{{ url('search') }}">{{ trans('app.search') }}</a></li>
                <li><a href="{{ url('board') }}">{{ trans('app.board') }}</a></li>
                <li><a href="{{ url('faq') }}">{{ trans('app.faq') }}</a></li>
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                       data-vivaldi-spatnav-clickable="1">
                        {{ trans('app.submit_content') }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href='{{ url('games/create') }}'>{{ trans('app.submit_game') }}</a></li>
                        <li><a href='{{ url('resources/create') }}'>{{ trans('app.submit_resource') }}</a></li>
                        <li><a href='{{ url('news/create') }}'>{{ trans('app.submit_news') }}</a></li>
                        <li><a href='{{ url('submit/logo') }}'>{{ trans('app.submit_logo') }}</a></li>
                        <li><a href='{{ url('logo/vote') }}'>{{ trans('app.rate_logos') }}</a></li>
                        <li class="divider"></li>
                        <li><a href='{{ url('missing/gamescreens') }}'>{{ trans('app.missing_screenshots') }}</a></li>
                        <li><a href='{{ url('missing/gamefiles') }}'>{{ trans('app.missing_gamefiles') }}</a></li>
                        <li><a href='{{ url('missing/gamedesc') }}'>{{ trans('app.missing_gamedescriptions') }}</a></li>
                        <li><a href='{{ url('missing/notags') }}'>{{ trans('app.games_without_tags') }}</a></li>
                        <div class="divider"></div>
                        @permission(('admin-user'))
                        <li><a href="{{ url('users/perm/role') }}">{{ trans('app.user_permissions') }}</a></li>
                        @endpermission
                        @permission(('admin-board'))
                        <li><a href="{{ url('board/create') }}">{{ trans('app.add_board_category') }}</a></li>
                        @endpermission
                        @permission(('admin-cdc'))
                        <li><a href="{{ url('cdc/create') }}">{{ trans('app.add_coupdecoeur') }}</a></li>
                        @endpermission
                        @permission(('create-faq'))
                        <li><a href="{{ url('faq/create') }}">{{ trans('app.add_faq') }}</a></li>
                        @endpermission
                        @permission(('create-awards'))
                        <li><a href="{{ url('awards/create') }}">{{ trans('app.add_faq_category') }}</a></li>
                        @endpermission
                        @permission(('admin-comments'))
                        <li><a href="{{ url('reported/comments') }}">{{ trans('app.reported_comments') }}</a></li>
                        @endpermission
                    </ul>
                </li>
                @endif
            </ul>
            {{ Form::open(['action' => ['SearchController@search'], 'class' => 'navbar-form navbar-right']) }}
                <div class="form-group">
                    <input type="text" class="form-control" id="term" name="term" placeholder="{{ trans('app.search') }}">
                </div>
            <button type="submit" class="btn btn-default">{{ trans('app.submit') }}</button>

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
                                '{{ trans('app.search_nothing_found') }}',
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
                            <li><a href="{{ action('MessagesController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.unreaded_pms') }} <span class="badge">{{\Auth::user()->newThreadsCount()}}</span></a></li>
                            <li><a href="{{ action('MessagesController@create') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.create_new_pm') }}</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ action('SavegameManagerController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.savegame_manager') }}</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{ action('UserSettingsController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.user_settings') }}</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ action('Auth\LoginController@logout') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.logout') }}</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ action('Auth\LoginController@showLoginForm') }}">{{ trans('app.login') }}</a></li>
                    <li><a href="{{ action('Auth\RegisterController@showRegistrationForm') }}">{{ trans('app.register') }}</a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>