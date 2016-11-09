<div class='rmarchivtbl' id='rmarchivbox_login'>
    <h2>{{ trans('app.auth.login') }}</h2>
    <div class='content loggedin'>
        {{ trans('app.auth.loggedin_as') }}<br/>
        <a href='?page=user&id={{ Auth::id() }}' class='usera' title="{{ Auth::user()->name  }}">
            <img src='http://ava.rmarchiv.de/?gender=geschlecht&id={{ Auth::id() }}' alt="{{ Auth::user()->name  }}" class='avatar'/>
        </a> <a href='?page=user&id={{ Auth::id() }}' class='user online'>{{ Auth::user()->name  }}</a></div>
    <div class='foot'>
        <a href='/?page=user_settings'>{{ trans('app.user.settings.title') }}</a> ::
        <a href='{{ url('logout') }}'>{{ trans('app.auth.logout') }}</a>
    </div>
</div>