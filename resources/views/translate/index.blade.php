@extends('layouts.app')
@section('content')
    <div id="content">
        <table id='pouetbox_userlist' class='boxtable pagedtable'>
            <thead>
                <th>sprache</th>
                <th>fertig</th>
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