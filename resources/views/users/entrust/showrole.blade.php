@extends('layouts.app')
@section('content')
    @include('users.entrust.partials.nav')
    <div id="content">
        @if (count($errors) > 0)
            <div class="rmarchivtbl errorbox">
                <h2>{{trans('app.permission_show_roles')}}</h2>
                <div class="content">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @if($perms->count() <> 0)
            <h2>benutzerrollen</h2>
            <table id='pouetbox_prodlist' class='boxtable pagedtable'>
                <thead>
                <tr class='sortable'>
                    <th>name</th>
                    <th>anzeigename</th>
                    <th>beschreibung</th>
                    <th>aktionen</th>
                </tr>
                </thead>
                @foreach($perms as $r)
                    <tr>
                        <td><a href="{{ action('UserPermissionController@showRole', $r->id) }}">{{ $r->name }}</a></td>
                        <td>{{ $r->display_name }}</td>
                        <td>{{ $r->description }}</td>
                        <td><a href="{{ route('user.perm.removefromrole', [$roleid, $r->id]) }}">[del]</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>dieser gruppe wurden keine bverechtigungen zugewiesen.</h2>
        @endif

        {!! Form::open(['route' => ['user.perm.permtorole', $roleid]]) !!}
        <div class="rmarchivtbl" id="rmarchivbox_submitprod">
            <h2>berechtigung hinzufügen</h2>

            <div class="content">
                <div class="formifier">
                    <div class='row' id='row_maker'>
                        <label for='perm'>berechtigung verknüpfen</label>
                        <select name='perm' id='perm'>
                            <option value="0">bitte berechtigung wählen</option>
                            @foreach($permstoadd as $perm)
                                <option value="{{ $perm->id }}">{{ $perm->name }}</option>
                            @endforeach
                        </select>
                        <span> [<span class="req">req</span>]</span>
                    </div>
                </div>

            </div>

            <div class="foot">
                <input type="submit" value="senden">
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection