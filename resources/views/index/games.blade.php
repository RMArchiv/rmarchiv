@foreach($games as $g)
{{$g->title}};{{$g->subtitle}};{{$g->relase_date}};@php PHP_EOL @endphp
@endforeach