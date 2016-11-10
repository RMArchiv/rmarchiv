<header>
    <h1>{{ trans('app.title') }}</h1>
    <div id='logo'>
        <a href="/"><img height="100px" src="content/logos/userid_logoid.logoext" alt="{{ config('app.name') }} Logo: logoname"/></a>
        <p>logo by <a href='pfad' class='user'>benutzername</a> :: {{ config('app.name') }} is brought to you by <a href="{{ url('users', 1) }}">ryg</a></p>
    </div>
</header>