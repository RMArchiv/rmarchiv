<div class="row justify-content-center">
   @include('_partials.header')
</div>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-controls="bs-example-navbar-collapse-2" aria-expanded="false" aria-label="{{ trans('app.toggle_navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">{{ trans('app.home') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('news') }}">{{ trans('app.news') }}</a></li>
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
                        <li><a href="{{ url('awards/create') }}">{{ trans('app.add_award') }}</a></li>
                        @endpermission
                        @permission(('admin-comments'))
                        <li><a href="{{ url('reported/comments') }}">{{ trans('app.reported_comments') }}</a></li>
                        @endpermission
                    </ul>
                </li>
                @endif
            </ul>
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

            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                           data-vivaldi-spatnav-clickable="1">
                            {{ trans('app.hello') }}, {{ Auth::user()->name }} <span class="caret"></span>
                            @if(\Auth::user()->newThreadsCount() >= 1)
                                <span class="badge">{{ \Auth::user()->newThreadsCount() }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="nav-item"><a class="nav-link" href="{{ action('MessagesController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.unreaded_pms') }} <span class="badge">{{\Auth::user()->newThreadsCount()}}</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ action('MessagesController@create') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.create_new_pm') }}</a></li>
                            <li class="divider"></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ action('SavegameManagerController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.savegame_manager') }}</a>
                            </li>
                            <li class="divider"></li>
                            <li class="nav-item"><a class="nav-link" href="{{ action('UserSettingsController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.user_settings') }}</a></li>
                            <li class="divider"></li>
                            <li class="nav-item"><a class="nav-link" href="{{ action('Auth\LoginController@logout') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.logout') }}</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="{{ action('Auth\LoginController@showLoginForm') }}">{{ trans('app.login') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ action('Auth\RegisterController@showRegistrationForm') }}">{{ trans('app.register') }}</a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>