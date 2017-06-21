@extends('layouts.app')
@section('pagetitle', trans('app.login'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.login') }}</h1>
                {!! Breadcrumbs::render('login') !!}
            </div>
        </div>
        {!! Form::open(['url' => '/login']) !!}
        @if (count($errors) > 0)
            <div class="row">
                <div class="alert alert-dismissible alert-warning">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Fehler!</h4>
                    <p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                    </p>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="well">
                <div class="form-horizontal">
                    <fieldset>
                        <legend>
                            {{ trans('app.login') }}
                        </legend>
                        <div class="form-group">
                            <label for="email" class="col-lg-2 control-label">{{trans('app.email_address')}}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="email" name="email" placeholder="e.mail@mail.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-lg-2 control-label">{{trans('app.password')}}</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('app.remember_login') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ trans('app.login') }}</button>
                            <div class="pull-right">
                                <a href="{{ url('/password/reset') }}">
                                    {{ trans('app.password_reset') }}
                                </a>
                                -
                                <a href='{{ url('register') }}'>{{ trans('app.register') }}</a>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
