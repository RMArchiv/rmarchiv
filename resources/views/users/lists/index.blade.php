@extends('layouts.app')
@section('pagetitle', 'benutzerlisten')
@section('content')
    <div id='content'>
        <h2>Spiele</h2>
        <table id='pouetbox_prodlist' class='boxtable pagedtable'>
            <thead>
            <tr class='sortable'>
                <th>liste</th>
                <th>spiele</th>
                <th>erstellt</th>
                <th>aktionen</th>
            </tr>
            </thead>

            @foreach($lists as $list)
                <tr>
                    <td>
                        <a href="{{ action('UserListController@show', [$list->user_id, $list->id]) }}">{{ $list->title }}</a>
                    </td>
                    <td>
                        {{ $list->count }}
                    </td>
                    <td>
                        {{ $list->created_at }}
                    </td>
                    <td>
                        @if(Auth::check())
                            @if(Auth::id() == $list->user_id)
                                [<a href="#">löschen</a>]
                            @else
                                @role(('admin'))
                                    [<a href="#">löschen</a>]
                                @endrole
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection