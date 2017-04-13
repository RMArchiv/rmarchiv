@extends('layouts.app')
@section('content')
    <div id="content">
        <table id='pouetbox_userlist' class='boxtable pagedtable'>
            <thead>
            <th>part</th>
            <th>basis ({{$loc1}})</th>
            <th>ziel ({{$loc2}})</th>
            </thead>
            @foreach($list as $l)
                <tr>
                    <td>{{ dd($l) }}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection