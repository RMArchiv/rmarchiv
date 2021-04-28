@include('_partials.header')

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="{{ trans('app.toggle_navigation') }}">
                <i class="fa fa-bars fa-lg py-1" style="color: #ffbf00;"></i>
            </button>
            <div class="collapse navbar-collapse" id="topNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">{{ trans('app.home') }}</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ url('news') }}">{{ trans('app.news') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('games') }}">{{ trans('app.games') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('resources') }}">{{ trans('app.resources') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('developer') }}">{{ trans('app.developers') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('makers') }}">{{ trans('app.makers') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('awards') }}">{{ trans('app.awards') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('users') }}">{{ trans('app.users') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('search') }}">{{ trans('app.search') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('board') }}">{{ trans('app.board') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('faq') }}">{{ trans('app.faq') }}</a></li>
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                               data-vivaldi-spatnav-clickable="1">
                                {{ trans('app.submit_content') }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href='{{ url('games/create') }}'>{{ trans('app.submit_game') }}</a>
                                <a class="dropdown-item" href='{{ url('resources/create') }}'>{{ trans('app.submit_resource') }}</a>
                                <a class="dropdown-item" href='{{ url('news/create') }}'>{{ trans('app.submit_news') }}</a>
                                <a class="dropdown-item" href='{{ url('submit/logo') }}'>{{ trans('app.submit_logo') }}</a>
                                <a class="dropdown-item" href='{{ url('logo/vote') }}'>{{ trans('app.rate_logos') }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href='{{ url('missing/gamescreens') }}'>{{ trans('app.missing_screenshots') }}</a>
                                <a class="dropdown-item" href='{{ url('missing/gamefiles') }}'>{{ trans('app.missing_gamefiles') }}</a>
                                <a class="dropdown-item" href='{{ url('missing/gamedesc') }}'>{{ trans('app.missing_gamedescriptions') }}</a>
                                <a class="dropdown-item" href='{{ url('missing/notags') }}'>{{ trans('app.games_without_tags') }}</a>
                                <div class="dropdown-divider"></div>
                                @permission(('admin-user'))
                                <a class="dropdown-item" href="{{ url('users/perm/role') }}">{{ trans('app.user_permissions') }}</a>
                                @endpermission
                                @permission(('admin-board'))
                                <a class="dropdown-item" href="{{ url('board/create') }}">{{ trans('app.add_board_category') }}</a>
                                @endpermission
                                @permission(('admin-cdc'))
                                <a class="dropdown-item" href="{{ url('cdc/create') }}">{{ trans('app.add_coupdecoeur') }}</a>
                                @endpermission
                                @permission(('create-faq'))
                                <a class="dropdown-item" href="{{ url('faq/create') }}">{{ trans('app.add_faq') }}</a>
                                @endpermission
                                @permission(('create-awards'))
                                <a class="dropdown-item" href="{{ url('awards/create') }}">{{ trans('app.add_award') }}</a>
                                @endpermission
                                @permission(('admin-comments'))
                                <a class="dropdown-item" href="{{ url('reported/comments') }}">{{ trans('app.reported_comments') }}</a>
                                @endpermission
                            </div>
                        </li>
                    @endif
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                               data-vivaldi-spatnav-clickable="1">
                                {{ trans('app.hello') }}, {{ Auth::user()->name }} <span class="caret"></span>
                                @if(\Auth::user()->newThreadsCount() >= 1)
                                    <span class="badge">{{ \Auth::user()->newThreadsCount() }}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{ action('MessagesController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.unreaded_pms') }} <span class="badge">{{\Auth::user()->newThreadsCount()}}</span></a>
                                <a class="dropdown-item" href="{{ action('MessagesController@create') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.create_new_pm') }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ action('SavegameManagerController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.savegame_manager') }}</a>
                                <a class="dropdown-item" href="{{ action('ReportController@index_user') }}" data-vivaldi-spatnav-clickable="1">Reported Games</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ action('UserSettingsController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.user_settings') }}</a>
                                <div class="dropdown-ivider"></div>
                                <a class="dropdown-item" href="{{ action('Auth\LoginController@logout') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.logout') }}</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ action('Auth\LoginController@showLoginForm') }}">{{ trans('app.login') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ action('Auth\RegisterController@showRegistrationForm') }}">{{ trans('app.register') }}</a></li>
                    @endif --}}
                </ul>

                {{--

                {{ Form::open(['action' => ['SearchController@search'], 'class' => 'form-inline my-2 my-lg-0']) }}
                <div class="form-inline mt-2 mt-md-0" style="flex-flow: nowrap">
                    <input type="text" class="form-control form-control-sm mr-sm-2" id="term" name="term" placeholder="{{ trans('app.search') }}">
                    <button type="submit" class="btn btn-outline-success my-2 my-sm-0 btn-sm">{{ trans('app.submit') }}</button>
                </div>


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

                --}}
            </div>
        </div>
    </div>
</nav>