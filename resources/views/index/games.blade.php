@foreach($games as $g)
{{$g->title}};{{$g->subtitle}};{{$g->release_date}};{!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($g->id) !!}/n
@endforeach