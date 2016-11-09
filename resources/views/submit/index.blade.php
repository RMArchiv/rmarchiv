@extends('layouts.app')

@section('content')
    @if(Auth::check() == true)
        Eingeloggt
    @else
        <div class="rmarchivtbl errorbox">
            <h2>{!! trans('app.errors.submit.no_login.title') !!}</h2>
            <div class="content">
                <strong>{!! trans('app.errors.submit.no_login.message', ['websitetitle' => config('app.name'), 'loginurl' => url('login'), 'registerurl' => url('register')]) !!}</strong>
            </div>
        </div>
    @endif

@endsection
