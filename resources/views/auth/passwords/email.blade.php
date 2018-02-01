@extends('layouts.app')

<!-- Main Content -->
@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_login'>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="content">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 col-form-label">E-Mail Adresse:</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="form-text">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Passwort Link zusenden
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
@endsection
