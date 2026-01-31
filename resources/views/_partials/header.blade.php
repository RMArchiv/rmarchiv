<div class="mt-1 mb-1">
    @php
        try {
            $logo = \Illuminate\Support\Facades\Cache::remember('header.random_logo', now()->addMinutes(10), function () {
                return \DB::table('logos')
                    ->leftJoin('users', 'logos.user_id', '=', 'users.id')
                    ->leftJoin('logo_votes', 'logos.id', '=', 'logo_votes.logo_id')
                    ->select(['logos.title', 'logos.filename', 'users.name', 'users.id', 'logos.id as logoid'])
                    ->whereRaw('(logo_votes.up - logo_votes.down) > 0')
                    ->inRandomOrder()
                    ->first();
            });
        } catch (\Throwable $e) {
            $logo = null;
        }
    @endphp
    @if($logo)
    <a href="/">
        <img class="mx-auto d-block h-100 w-100" style="object-fit: contain; max-height:100px" src="{{ route('logo.show', $logo->logoid) }}" alt="Logo: {{ $logo->title }}"/>
    </a>
    <p class="text-center small d-sm-none mb-1">logo '{{ $logo->title }}' by <a href='{{ url('users', $logo->id) }}' class='user'>{{ $logo->name }}</a> :: {{ config('app.name') }} is brought to you with love.</p>
    <p class="text-center d-none d-sm-block">logo '{{ $logo->title }}' by <a href='{{ url('users', $logo->id) }}' class='user'>{{ $logo->name }}</a> :: {{ config('app.name') }} is brought to you with love.</p>
    @else
        <p class="text-center">No Logo until now!</p>
    @endif
</div>
