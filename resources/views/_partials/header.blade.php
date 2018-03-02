<div>
    @php
        $logo = \DB::table('logos')
        ->leftJoin('users', 'logos.user_id', '=', 'users.id')
        ->leftJoin('logo_votes', 'logos.id', '=', 'logo_votes.logo_id')
        ->select(['logos.title', 'logos.filename', 'users.name', 'users.id'])
        ->whereRaw('(logo_votes.up - logo_votes.down) > 0')
        ->inRandomOrder()
        ->first();

        $fname = str_replace('storage/logos/', '',$logo->filename)
    @endphp
    <a href="/">
        <img class="mx-auto d-block" height="100px" src="{{ url('logo/'.$fname) }}" alt="Logo: {{ $logo->title }}"/>
    </a>
    <p>logo '{{ $logo->title }}' by <a href='{{ url('users', $logo->id) }}' class='user'>{{ $logo->name }}</a> :: {{ config('app.name') }} is brought to you with love.</p>
</div>
