<header>
    <h1>{{ trans('app.title') }}</h1>
    <div id='logo'>
        {{-- <a href="/"><img height="100px" src="{{ url('logo/'.$logo->filename) }}" alt="Logo: {{ $logo->title }}"/></a> --}}
        <a href="/">LOGO</a>
        <p>logo '{{ $logo->title }}' by <a href='{{ url('users', $logo->id) }}' class='user'>{{ $logo->name }}</a> :: {{ config('app.name') }} is brought to you with love.</p>
    </div>
</header>