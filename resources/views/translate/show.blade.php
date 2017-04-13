@extends('layouts.app')
@section('content')
    <div id="content">
        <table id='pouetbox_userlist' class='boxtable pagedtable'>
            <thead>
            <th>part</th>
            <th>basis ({{$loc1}})</th>
            <th>ziel ({{$loc2}})</th>
            </thead>
            @foreach($list as $lng)
                <tr>
                    <td><a href="{{ action('TranslationController@edit', ['de', $lng['loc']]) }}">{{ $lng['loc'] }}</a></td>
                    <td>{{ $lng['perc'] }}%</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection