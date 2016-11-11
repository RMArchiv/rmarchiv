<header>
    <h1>{{ trans('app.title') }}</h1>
    <div id='logo'>
        <a href="/"><img height="100px" src="{{ asset($logo->filename) }}" alt="Logo: {{ $logo->title }}"/></a>
        <p>logo '{{ $logo->title }}' by <a href='pfad' class='user'>{{ $logo->name }}</a> :: {{ config('app.name') }} is brought to you by <a href="{{ url('users', 1) }}">ryg</a></p>
    </div>
</header>