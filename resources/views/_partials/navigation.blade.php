@include('_partials.header')

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="{{ trans('app.toggle_navigation') }}">
                <i class="fa fa-bars fa-lg py-1" style="color: #ffbf00;"></i>
            </button>
            <form method="POST" action="{{ action("SearchController@search")}}" class="d-lg-none col-9 col-sm-6">
                @csrf
                <input class="d-none" id="inputTerm" autocomplete="off" type='text' name='term' size='64' placeholder="Suche hier" />
                <div id="autocomplete"></div>
                <div id="searchcontainer"></div>
                <script type="module">
                    createAutocomplete(
                    {   apiPath:()=>{return "ac_search_new"},
                        placeholder:"{{ trans('app.search') }}",
                        searchbarSelector:"#autocomplete",
                        panelSelector:"#searchcontainer",
                        inputSelector:"#inputTerm",
                        noResults:'{{ trans('app.search_nothing_found') }}',
                        type:"games",
                        action:"navigate",
                        additonalSubProps: {},
                        additionalProps:{onSubmit: ()=>{document.querySelector("#autocomplete").closest("form").submit()}}
                    })
                </script>
            </form>
            <div class="collapse navbar-collapse" id="topNav">
                <hr class="d-block d-lg-none mx-1 mt-2 mb-1">
                    <div class="dropdown-divider"></div>
                </hr>
                <ul class="navbar-nav w-100 flex-row justify-content-lg-between ps-3 ps-lg-0">
                    <div class="navbar-nav d-flex">
                        <li class="d-none d-lg-flex nav-item align-items-center mx-1 my-1"><a class="nav-link w-auto fa fa-house" href="{{ url('/') }}"></a></li>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('news') }}">{{ trans('app.news') }}</a></li>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('games') }}">{{ trans('app.games') }}</a></li>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('resources') }}">{{ trans('app.resources') }}</a></li>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('developer') }}">{{ trans('app.developers') }}</a></li>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('makers') }}">{{ trans('app.makers') }}</a></li>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('awards') }}">{{ trans('app.awards') }}</a></li>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('users') }}">{{ trans('app.users') }}</a></li>
                        <noscript>
                            <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('search') }}">{{ trans('app.search') }}</a></li>
                        </noscript>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('board') }}">{{ trans('app.board') }}</a></li>
                        <li class="nav-item  d-flex align-items-center"><a class="nav-link" href="{{ url('faq') }}">{{ trans('app.faq') }}</a></li>
                    </div>
                    <div class="navbar-nav d-none d-lg-flex me-2 gap-1">
                        @if(Auth::check())
                            <li class="nav-item dropdown px-1 d-none d-lg-flex align-items-center">
                                <a href="#" class="nav-link dropdown-toggle rounded-pill bg-black d-flex gap-2 align-items-center" data-bs-toggle="dropdown" role="button" aria-expanded="false"
                                data-vivaldi-spatnav-clickable="1">
                                    <span class="lh-base fa fa-upload"></span>
                                    <span class="lh-base caret"></span>
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
                            <li class="nav-item dropdown px-1 d-none d-lg-flex align-items-center">
                                <a href="#" class="nav-link dropdown-toggle rounded-pill bg-black block d-lg-flex gap-2 align-items-center" data-bs-toggle="dropdown" role="button" aria-expanded="false"
                                data-vivaldi-spatnav-clickable="1">
                                    <img onerror="this.onerror=null; this.src='/assets/icon_rmarchiv.png'" width="16px" src='//{{ config('app.avatar_path') }}?gender=male&id={{ Auth::user()->id  }}' alt="{{ Auth::user()->name }}" class='avatar' />
                                    {{-- alternative icon --}}
                                    {{-- <span class="lh-base fa-regular fa-user"></span> --}}
                                    <span>
                                        <span>{{ Auth::user()->name }}</span>
                                        <span class="lh-base caret"></span>
                                    </span>
                                    @if(\Auth::user()->newThreadsCount() >= 1)
                                        <span class="badge">{{ \Auth::user()->newThreadsCount() }}</span>
                                    @endif
                                </a>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="{{ action('MessagesController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.unreaded_pms') }} <span class="badge">{{\Auth::user()->newThreadsCount()}}</span></a>
                                    <a class="dropdown-item" href="{{ action('MessagesController@create') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.create_new_pm') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ action('UserListController@index', [Auth::user()->id]) }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.userlists') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ action('SavegameManagerController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.savegame_manager') }}</a>
                                    <a class="dropdown-item" href="{{ action('ReportController@index_user') }}" data-vivaldi-spatnav-clickable="1">Reported Games</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ action('UserSettingsController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.user_settings') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ action('Auth\LoginController@logout') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.logout') }}</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item px-1 d-none d-lg-flex align-items-center"><a class="nav-link rounded-pill bg-black d-flex flex-row align-items-center gap-2" href="{{ action('Auth\LoginController@showLoginForm') }}"><i class="fa fa-sign-in w-auto"></i><span class="d-xl-block d-none">{{trans("app.login")}}</span></a></li>
                            <li class="nav-item px-1 d-none d-lg-flex align-items-center"><a class="nav-link rounded-pill bg-black d-flex flex-row align-items-center gap-2" href="{{ action('Auth\RegisterController@showRegistrationForm') }}"><i class="fa fa-address-card w-auto"></i><span class="d-xl-block d-none">{{trans("app.register")}}</span></a></li>
                        @endif
                    </div>
                    <ul class="inner-icons d-flex flex-column d-lg-none gap-1 w-100" id="authCollapsedParent">
                        @if(Auth::check())
                            <div class="dropstart gap-1">
                                <button href="#" class="dropdown-toggle nav-link p-2 rounded-pill bg-black d-flex flex-row align-items-center gap" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    aria-controls="collapse-submission">
                                    <span class="lh-base fa fa-upload"></span>
                                    <span class="lh-base caret"></span>
                                </button>
                                <div class="dropdown-menu position-relative z-5 end-0 border-0" style="min-width: 0%" data-bs-parent="#authCollapsedParent" id="collapse-submission">
                                    <div class="card card-body position-absolute end-0">
                                        <div class="total-overview-container d-flex flex-column gap-2">
                                            <div class="total-overview d-flex flex-wrap">
                                                            <a class="dropdown-item text-wrap" href='{{ url('games/create') }}'>{{ trans('app.submit_game') }}</a>
                                                            <a class="dropdown-item text-wrap" href='{{ url('resources/create') }}'>{{ trans('app.submit_resource') }}</a>
                                                            <a class="dropdown-item text-wrap" href='{{ url('news/create') }}'>{{ trans('app.submit_news') }}</a>
                                                            <a class="dropdown-item text-wrap" href='{{ url('submit/logo') }}'>{{ trans('app.submit_logo') }}</a>
                                                            <a class="dropdown-item text-wrap" href='{{ url('logo/vote') }}'>{{ trans('app.rate_logos') }}</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item text-wrap" href='{{ url('missing/gamescreens') }}'>{{ trans('app.missing_screenshots') }}</a>
                                                            <a class="dropdown-item text-wrap" href='{{ url('missing/gamefiles') }}'>{{ trans('app.missing_gamefiles') }}</a>
                                                            <a class="dropdown-item text-wrap" href='{{ url('missing/gamedesc') }}'>{{ trans('app.missing_gamedescriptions') }}</a>
                                                            <a class="dropdown-item text-wrap" href='{{ url('missing/notags') }}'>{{ trans('app.games_without_tags') }}</a>
                                                            <div class="dropdown-divider"></div>
                                                            @permission(('admin-user'))
                                                            <a class="dropdown-item text-wrap" href="{{ url('users/perm/role') }}">{{ trans('app.user_permissions') }}</a>
                                                            @endpermission
                                                            @permission(('admin-board'))
                                                            <a class="dropdown-item text-wrap" href="{{ url('board/create') }}">{{ trans('app.add_board_category') }}</a>
                                                            @endpermission
                                                            @permission(('admin-cdc'))
                                                            <a class="dropdown-item text-wrap" href="{{ url('cdc/create') }}">{{ trans('app.add_coupdecoeur') }}</a>
                                                            @endpermission
                                                            @permission(('create-faq'))
                                                            <a class="dropdown-item text-wrap" href="{{ url('faq/create') }}">{{ trans('app.add_faq') }}</a>
                                                            @endpermission
                                                            @permission(('create-awards'))
                                                            <a class="dropdown-item text-wrap" href="{{ url('awards/create') }}">{{ trans('app.add_award') }}</a>
                                                            @endpermission
                                                            @permission(('admin-comments'))
                                                            <a class="dropdown-item text-wrap" href="{{ url('reported/comments') }}">{{ trans('app.reported_comments') }}</a>
                                                            @endpermission
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropstart gap-1">
                                <button href="#" class="dropdown-toggle nav-link p-2 rounded-pill bg-black d-flex flex-row align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    aria-controls="collapse-submission2">
                                    <img onerror="this.onerror=null; this.src='/assets/icon_rmarchiv.png'" width="16px" src='//{{ config('app.avatar_path') }}?gender=male&id={{ Auth::user()->id  }}' alt="{{ Auth::user()->name }}" class='avatar' />
                                    {{-- alternative icon --}}
                                    {{-- <span class="lh-base fa-regular fa-user"></span> --}}
                                    <span>
                                        <span>{{ Auth::user()->name }}</span>
                                        <span class="lh-base caret"></span>
                                    </span>
                                    @if(\Auth::user()->newThreadsCount() >= 1)
                                        <span class="badge">{{ \Auth::user()->newThreadsCount() }}</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu position-relative z-5 end-0 border-0" style="min-width: 0%" data-bs-parent="#authCollapsedParent" id="collapse-submission2">
                                    <div class="card card-body position-absolute end-0">
                                        <div class="total-overview-container d-flex flex-column gap-2">
                                            <div class="total-overview d-flex flex-wrap">
                                                <a class="dropdown-item text-wrap d-flex" href="{{ action('MessagesController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.unreaded_pms') }} <span class="badge bg-primary aligh-self-start ms-1" style="align-self: flex-start">{{\Auth::user()->newThreadsCount()}}</span></a>
                                                <a class="dropdown-item text-wrap" href="{{ action('MessagesController@create') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.create_new_pm') }}</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-wrap" href="{{ action('UserListController@index', [Auth::user()->id]) }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.userlists') }}</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-wrap" href="{{ action('SavegameManagerController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.savegame_manager') }}</a>
                                                <a class="dropdown-item text-wrap" href="{{ action('ReportController@index_user') }}" data-vivaldi-spatnav-clickable="1">Reported Games</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-wrap" href="{{ action('UserSettingsController@index') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.user_settings') }}</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-wrap" href="{{ action('Auth\LoginController@logout') }}" data-vivaldi-spatnav-clickable="1">{{ trans('app.logout') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <li class="nav-item px-1 d-flex d-lg-none align-items-center"><a class="nav-link p-2 rounded-pill bg-black d-flex flex-row align-items-center gap-2" href="{{ action('Auth\LoginController@showLoginForm') }}"><i class="fa fa-sign-in w-auto"></i><span class="d-block">{{trans("app.login")}}</span></a></li>
                            <li class="nav-item px-1 d-flex d-lg-none align-items-center"><a class="nav-link p-2 rounded-pill bg-black d-flex flex-row align-items-center gap-2" href="{{ action('Auth\RegisterController@showRegistrationForm') }}"><i class="fa fa-address-card w-auto"></i><span class="d-block">{{trans("app.register")}}</span></a></li>
                        @endif
                    </ul>
                </ul>

                <form method="POST" action="{{ action("SearchController@search")}}" class="d-none d-lg-block flex-grow-1 col-3 mw-40">
                    @csrf
                    <input class="d-none" id="inputTerm-large" autocomplete="off" type='text' name='term' size='64' placeholder="Suche hier" />
                    <div id="autocomplete-large"></div>
                    <div id="searchcontainer-large"></div>
                    <script type="module">
                        createAutocomplete(
                        {   apiPath:()=>{return "ac_search_new"},
                            placeholder:"{{ trans('app.search') }}",
                            searchbarSelector:"#autocomplete-large",
                            panelSelector:"#searchcontainer-large",
                            inputSelector:"#inputTerm-large",
                            noResults:'{{ trans('app.search_nothing_found') }}',
                            type:"games",
                            action:"navigate",
                            additonalSubProps: {},
                            additionalProps:{onSubmit: ()=>{document.querySelector("#autocomplete-large").closest("form").submit()}}
                        })
                    </script>
                </form>
            </div>

    </div>
</nav>