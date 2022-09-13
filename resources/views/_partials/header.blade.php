<div class="mt-1 mb-1">
    @php
        $logo = \DB::table('logos')
        ->leftJoin('users', 'logos.user_id', '=', 'users.id')
        ->leftJoin('logo_votes', 'logos.id', '=', 'logo_votes.logo_id')
        ->select(['logos.title', 'logos.filename', 'users.name', 'users.id'])
        ->whereRaw('(logo_votes.up - logo_votes.down) > 0')
        ->inRandomOrder()
        ->first();

    @endphp
    @if($logo)
    <a href="/">
        <img class="mx-auto d-block" height="100px" src="{{ Storage::url($logo->filename) }}" alt="Logo: {{ $logo->title }}"/>
    </a>
    <p class="text-center">logo '{{ $logo->title }}' by <a href='{{ url('users', $logo->id) }}' class='user'>{{ $logo->name }}</a> :: {{ config('app.name') }} is brought to you with love.</p>
    @else
        <p class="text-center">No Logo until now!</p>
    @endif
</div>
