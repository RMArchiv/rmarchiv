@extends('layouts.app')

@section('content')
<div id='content'>
    <table id='pouetbox_userlist' class='boxtable pagedtable'>
        <thead class='sortable'>
        <th>nickname</th>
        <th>mitglied seit</th>
        <th>level</th>
        <th>obyx</th>
        </thead>
        @foreach($users as $user)
        <tr>
            <td>
                <a href='/?page=user&id={{ $user->id }}' class='usera' title="{{ $user->name }}">
                    <img src='http://ava.rmarchiv.de/?gender=male&id={{ $user->id }}' alt="{{ $user->name }}" class='avatar'/>
                </a> <a href='/?page=user&id={{ $user->id }}' class='user'>{{ $user->name }}</a></td>
            <td class='date'>
                <span title="{{ $user->created_at }}"><!-- {{ $user->created_at }} -->{{ $user->created_at }}</span>
            </td>
            <td>
                @if($user->settings->is_admin == 1)
                    {{ trans('app.user.user_level.admin') }}
                @else
                    @if($user->settings->is_moderator == 1)
                        {{ trans('app.user.user_level.moderator') }}
                    @else
                        {{ trans('app.user.user_level.user') }}
                    @endif
                @endif
            </td>
            <td>
                <div class='innerbar_solo' style='width: 50px' title='50 obeys'>&nbsp;<span>50 obeys</span></div>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $users->links() }}
</div>
@endsection