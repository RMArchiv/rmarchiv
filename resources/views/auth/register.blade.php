@extends('layouts.app')
@section('pagetitle', trans('app.register_account'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.register_account') }}</h1>
                {!! Breadcrumbs::render('register') !!}
            </div>
        </div>

        <div id="row">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="panel panel-default">
                    @if ($errors->has('name'))
                        <div class="rmarchivtbl errorbox">
                            <h2>{{ trans('app.registration_failed') }}</h2>
                            <div class="content">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        </div>
                    @endif
                    @if ($errors->has('email'))
                        <div class="rmarchivtbl errorbox">
                            <h2>{{ trans('app.registration_failed') }}</h2>
                            <div class="content">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="rmarchivtbl errorbox">
                            <h2>{{ trans('app.registration_failed') }}</h2>
                            <div class="content">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        </div>
                    @endif
                    @if ($errors->has('captcha'))
                        <div class="rmarchivtbl errorbox">
                            <h2>{{ trans('app.registration_failed') }}</h2>
                            <div class="content">
                                <strong>{{ $errors->first('captcha') }}</strong>
                            </div>
                        </div>
                    @endif

                    <div class="panel-body">
                        <div class="formifier">
                            {!! Honeypot::generate('my_name', 'my_time') !!}
                            <div class="form-group" id="row_name">
                                <label for="name" class="col-lg-2 control-label">{{ trans('app.username') }}</label>
                                <div class="col-lg-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>
                            <div class="form-group" id="row_name">
                                <label  for="email" class="col-lg-2 control-label">e-mail adresse:</label>
                                <div class="col-lg-10">
                                <input id="email" type="email" class="col-md-4 form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="form-group" id="row_pass">
                                <label for="password" class="col-lg-2 control-label">passwort: </label>
                                <div class="col-lg-10">
                                <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group" id="row_pass2">
                                <label for="password-confirm" class="col-lg-2 control-label">passwort bestätigung:</label>
                                <div class="col-lg-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group" id="row_captcha">
                                <label for="captcha" class="col-lg-2 control-label">captcha:</label>
                                <div class="col-lg-10">
                                {!! captcha_img('rmarchiv') !!}
                                <input id="captcha" class="form-control" name="captcha" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    senden
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
