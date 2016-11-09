@extends('layouts.app')

@section('content')
    <div id="content">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitavatar">
                <h2>{{ trans('app.auth.register_title') }}</h2>

                @if ($errors->has('name'))
                    <div class="rmarchivtbl errorbox">
                        <h2>{{ trans('app.auth.register_failed') }}</h2>
                        <div class="content">
                            <strong>{{ $errors->first('name') }}</strong>
                        </div>
                    </div>
                @endif
                @if ($errors->has('email'))
                    <div class="rmarchivtbl errorbox">
                        <h2>{{ trans('app.auth.register_failed') }}</h2>
                        <div class="content">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="rmarchivtbl errorbox">
                        <h2>{{ trans('app.auth.register_failed') }}</h2>
                        <div class="content">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    </div>
                @endif

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_name">
                            <label for="name" class="col-md-4 control-label">{{ trans('app.auth.username') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_name">
                            <label for="email" class="col-md-4 control-label">{{ trans('app.auth.email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_pass">
                            <label for="password" class="col-md-4 control-label">{{ trans('app.auth.password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_pass2">
                            <label for="password-confirm" class="col-md-4 control-label">{{ trans('app.auth.password_confirm') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                {{trans('app.auth.register')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
