<div class='rmarchivtbl' id='rmarchivbox_login'>
    <h2>{{ trans('index.login.title') }}</h2>
    <div class='content loggedout'>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                @if ($errors->has('email'))
                    <div class="rmarchivtbl errorbox">
                        <h2>{{ trans('app.login_failed') }}</h2>
                        <div class="content">
                            <strong>{{ $errors->first('email') }}</strong>
                        </div>
                    </div>
                @endif

                @if ($errors->has('password'))
                    <div class="rmarchivtbl errorbox">
                        <h2>{{ trans('app.login_failed') }}</h2>
                        <div class="content">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    </div>
                @endif
                <label for="email" class="col-md-4 control-label">{{ trans('index.login.email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">{{ trans('index.login.email') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> {{ trans('index.login.remember_me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        {{ trans('index.login.login') }}
                    </button>

                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                        {{ trans('index.login.password_reset') }}
                    </a>
                </div>
            </div>
        </form>
        <a href='{{ url('register') }}'>{{ trans('index.login.register') }}</a>
    </div>
</div>