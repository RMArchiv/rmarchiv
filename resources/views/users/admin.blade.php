@extends('layouts.app')
@section('pagetitle', 'benutzeradministration')
@section('content')
    <div id="content">
        <form action="{{ url('users/admin', $user->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="rmarchivtbl" id="rmarchivbox_useradmin">
                <h2>{{ trans('user.admin.administration_of') }}: {{ $user->name }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('user.admin.error') }}</h2>
                    <div class="content">
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="content">
                    <div class="formifier">
                        <div class='row' id='row_maker'>
                            <label for='perm'>{{ trans('user.admin.linkpermission') }}</label>
                            <select name='perm' id='perm'>
                                <option value="0">{{ trans('user.admin.selectpermission') }}</option>
                                @foreach($perms as $perm)
                                    @if($perm->id == $user->hasRole($perm->name))
                                        <option selected="selected" value="{{ $perm->id }}">{{ $perm->name }}</option>
                                    @else
                                        <option value="{{ $perm->id }}">{{ $perm->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="{{ trans('user.admin.send') }}">
                </div>
            </div>


        </form>
    </div>
@endsection