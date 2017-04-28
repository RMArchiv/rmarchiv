@extends('layouts.app')
@section('content')
    <div id="content">
        <table id='pouetbox_userlist' class='boxtable pagedtable'>
            <thead>
            <th>group</th>
            <th>item</th>
            <th>basis ({{$loc1}})</th>
            <th>ziel ({{$loc2}})</th>
            </thead>
            @foreach($list as $l)
                <tr>
                    <td>{{ $l->group }}</td>
                    <td>{{ $l->item }}</td>
                    <td>{{ $l->text }}</td>
                    <td>
                        {!! Form::open(['method' => 'POST', 'route' => ['trans.save']]) !!}
                            {!! Form::hidden('loc1', $loc1) !!}
                            {!! Form::hidden('loc2', $loc2) !!}
                            {!! Form::hidden('loc1_orig', $l->text) !!}
                            {!! Form::hidden('id', $l->id) !!}
                            <input name="transstring" id="transstring" value=""/>
                            <input type="submit" value="!">
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection