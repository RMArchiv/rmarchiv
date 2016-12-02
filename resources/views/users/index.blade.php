@extends('layouts.app')
@section('pagetitle', 'benutzerliste')
@section('content')
<div id='content'>
    <table id='pouetbox_userlist' class='boxtable pagedtable'>
        <thead class='sortable'>
        <th>nickname</th>
        <th>mitglied seit</th>
        <th>level</th>
        <th>obyx</th>
        @if(Auth::check())
            @if(Auth::user()->settings->is_admin)
                <th>actions</th>
            @endif
        @endif
        </thead>
        @foreach($users as $user)
        <tr>
            <td>
                <a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">
                    <img src='http://ava.rmarchiv.de/?gender=male&id={{ $user->id }}' alt="{{ $user->name }}" class='avatar'/>
                </a> <a href='{{ url('users', $user->id) }}' class='user'>{{ $user->name }}</a></td>
            <td class='date'>
                <span title="{{ $user->created_at }}"><!-- {{ $user->created_at }} -->{{ $user->created_at }}</span>
            </td>
            <td>
                <span title="{{ $user->roles[0]->description }}">{{ $user->roles[0]->display_name }}</span>
            </td>
            <td>
                <div class='innerbar_solo' style='width: 50px' title='50 obeys'>&nbsp;<span>50 obeys</span></div>
            </td>
            @if(Auth::check())
                @if(Auth::user()->settings->is_admin)
                    <td><a href="{{ route('user.admin', $user->id) }}">[edit]</a></td>
                @endif
            @endif
        </tr>
        @endforeach
    </table>
    {{ $users->links() }}
</div>
@endsection