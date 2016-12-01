@extends('layouts.app')
@section('content')
    <div id="content">
        <form action="{{ url('users/admin', $user->uid) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="rmarchivtbl" id="rmarchivbox_useradmin">
                <h2>benutzeradministration für: {{ $user->uname }}</h2>

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
                        <div class="row" id="row_ismod">
                            <label for="moderator">moderator</label>
                            <input type="checkbox" name="moderator" {{ ($user->usmod == 1) ? 'checked="checked"' : '' }}>
                        </div>
                        <div class="row" id="row_admin">
                            <label for="admin">admin</label>
                            <input type="checkbox" name="admin" {{ ($user->usadmin == 1) ? 'checked="checked"' : '' }}>
                        </div>
                        <div class="row" id="row_banned">
                            <label for="banned">gebannt</label>
                            <input type="checkbox" name="banned" {{ ($user->usbanned == 1) ? 'checked="checked"' : '' }}>
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