<table>
    <tr>
        <td>Titel</td>
        <td>Untertitel</td>
        <td>Release Date</td>
        <td>Entwickler</td>
    </tr>
    @foreach($games as $g)
        <tr>
            <td>{{$g->title}}</td>
            <td>{{$g->subtitle}}</td>
            <td>{{$g->release_date}}</td>
            <td>{!! \App\Helpers\DatabaseHelper::getDevelopersList($g->id) !!}</td>
        </tr>
    @endforeach
</table>
