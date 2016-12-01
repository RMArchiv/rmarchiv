@extends('layouts.app')

@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_login'>
            <h2>{{ trans('app.auth.login') }}</h2>

            @if ($errors->has('email'))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.auth.login_failed') }}</h2>
                    <div class="content">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                </div>
            @endif

            @if ($errors->has('password'))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.auth.login_failed') }}</h2>
                    <div class="content">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_email">
                            <label for="email">{{ trans('app.auth.email') }}</label>
                            <input name="email" id="email" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_password">
                            <label for="password">{{ trans('app.auth.password') }}</label>
                            <input type="password" name="password" id="password" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_checkbox">
                            <label for="checkbox">{{ trans('app.auth.remember_me') }}</label>
                            <input type="checkbox" name="remember">
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <button type="submit" class="btn btn-primary">
                        {{ trans('app.auth.login') }}
                    </button>
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                        {{ trans('app.auth.password_reset') }}
                    </a>
                </div>
            </form>
            <a href='{{ url('register') }}'>{{ trans('app.auth.register') }}</a>
        </div>
    </div>
@endsection
