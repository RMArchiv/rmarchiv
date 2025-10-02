@php
    $devs = \App\Helpers\DatabaseHelper::getDevelopersUrlList($gameid);
@endphp
@foreach ($devs as $key => $dev)
    <a href="{{ url('developer', $dev->id) }}">{{ $dev->name }}</a>
    {{ count($devs) - 1 > $key ? ' ' . (isset($separator) ? $separator : '::') . ' ' : '' }}
@endforeach
