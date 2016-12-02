@extends('layouts.app')
@section('content')
    <div id="content">
        <form action="{{ url('users/admin', $user->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="rmarchivtbl" id="rmarchivbox_useradmin">
                <h2>benutzeradministration für: {{ $user->name }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.submit.logo.error.title') }}</h2>
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
                            <label for='perm'>berechtigung verknüpfen</label>
                            <select name='perm' id='perm'>
                                <option value="0">bitte berechtigung wählen</option>
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
                    <input type="submit" value="{{ trans('app.misc.send') }}">
                </div>
            </div>


        </form>
    </div>
@endsection