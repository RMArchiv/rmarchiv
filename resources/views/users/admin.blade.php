@extends('layouts.app')
@section('pagetitle', trans('app.user_administration'))
@section('content')
    <div id="content">
        <form action="{{ url('users/admin', $user->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="rmarchivtbl" id="rmarchivbox_useradmin">
                <h2>{{ trans('app.administration_of') }}: {{ $user->name }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.user_administration_error') }}</h2>
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
                            <label for='perm'>{{ trans('app.link_permission_to_user') }}</label>
                            <select name='perm' id='perm'>
                                <option value="0">{{ trans('app.choose_permission') }}</option>
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
                    <input type="submit" value="{{ trans('app.submit') }}">
                </div>
            </div>


        </form>
    </div>
@endsection