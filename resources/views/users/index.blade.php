@extends('layouts.app')
@section('pagetitle', 'benutzerliste')
@section('content')
<div id='content'>
    <table id='pouetbox_userlist' class='boxtable pagedtable'>
        <thead class='sortable'>
            <th>{{ trans('user.index.nickname') }}</th>
            <th>{{ trans('user.index.member_since') }}</th>
            <th>{{ trans('user.index.level') }}</th>
            <th>{{ trans('user.index.obyx') }}</th>
            @if(Auth::check())
                @if(Auth::user()->settings->is_admin)
                    <th>{{ trans('user.index.actions') }}</th>
                @endif
            @endif
        </thead>
        @foreach($users as $user)
        <tr>
            <td>
                <a href='{{ url('users', $user->userid) }}' class='usera' title="{{ $user->username }}">
                    <img src='http://ava.rmarchiv.de/?gender=male&id={{ $user->userid }}' alt="{{ $user->username }}" class='avatar'/>
                </a> <a href='{{ url('users', $user->userid) }}' class='user'>{{ $user->username }}</a></td>
            <td class='date'>
                <span title="{{ $user->usercreated_at }}"><!-- {{ $user->usercreated_at }} -->{{ $user->usercreated_at }}</span>
            </td>
            <td>
                <span title="{{ $user->roledesc }}">{{ $user->rolename }}</span>
            </td>
            <td>
                <div class='innerbar_solo' style='width: {{ ($user->obyx / $obyxmax->value) * 100 }}px' title='{{ $user->obyx or 0 }} obyx'>&nbsp;<span>{{ $user->obyx or 0 }} obyx</span></div>
            </td>
            @if(Auth::check())
                @if(Auth::user()->settings->is_admin)
                    <td>[<a href="{{ route('user.admin', $user->userid) }}">{{ trans('user.index.edit') }}</a>]</td>
                @endif
            @endif
        </tr>
        @endforeach
    </table>
    {{-- $users->links() --}}
</div>
@endsection