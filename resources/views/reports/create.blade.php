@extends('layouts.app')
@section('pagetitle', trans('app.report_game'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>
                        @if($game->subtitle)
                            {{ $game->title }}
                            <small> - {{ $game->subtitle }}</small> {{ trans('app.report_game') }}
                        @else
                            {{ $game->title }} {{ trans('app.report_game') }}
                        @endif

                    </h1>
                    {!! Breadcrumbs::render('game-report', $game) !!}
                </div>
            </div>
        </div>
        <div class="row">
            @if(Auth::check())
                {!! Form::open(['method' => 'POST', 'route' => ['game-report.store', $game->id]]) !!}
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{ trans('app.report_game') }}
                            </div>
                            <div class="card-body">
                                @include('_partials.markdown_editor')
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="{{trans('app.submit')}}" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            @else
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Keine Berechtigung / Missing Permissions
                        </div>
                        <div class="card-body">
                            Momentan können Spiele Repots nur mit einem registrierten Benutzeraccount gesendet werden.<br>
                            Alternativ kann eine E-Mail an <a href="mailto:report@rmarchiv.de">report@rmarchiv.de</a> gesendet werden<br>
                            <br>
                            Currently, system-side game reports can only be created with an registered user account.<br>
                            Alternatively you can send an e-mail to <a href="mailto:report@rmarchiv.de">report@rmarchiv.de</a><br>
                            <br>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection