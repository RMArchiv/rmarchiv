@extends('layouts.app')
@section('pagetitle', 'user online')
@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_grouplist'>
            <table id="rmarchiv_creatortable" class='boxtable'>
                <thead>
                <tr class='sortable'>
                    <th>
                        {{ trans('user.online.username') }}
                    </th>
                    <th>
                        {{ trans('user.online.last_page') }}
                    </th>
                    <th>
                        {{ trans('user.online.last_action_date') }}
                    </th>
                </tr>
                </thead>
                @foreach($uo as $u)
                    <tr>
                        <td><a href="{{ action('UserController@show', $u->user_id) }}">{{ $u->user->name }}</a></td>
                        <td><a href="{{ $u->last_place }}">{{ $u->last_place }}</a></td>
                        <td>{{ $u->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection