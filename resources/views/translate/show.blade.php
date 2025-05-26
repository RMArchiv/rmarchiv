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
                        <form method="POST" action="{{ route('trans.save')}}">
                        @csrf
                            <input type="hidden" name='loc1' value="{{ $loc1 }}">
                            <input type="hidden" name='loc2' value="{{ $loc2 }}">
                            <input type="hidden" name='loc1_orig' value="{{ $l->text }}">
                            <input type="hidden" name='id' value="{{ $l->id }}">
                            <input name="transstring" id="transstring" value=""/>
                            <input type="submit" value="!">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection