@extends('layouts.app')
@section('pagetitle', trans('app.rate_logos'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.rate_logos') }}</h1>
                    {!! Breadcrumbs::render('logorating') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(count($logos) > 0)
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.rate_logos') }}
                    </div>
                    <div class="card-body">
                        {{ trans('app.please_rate_this_logo') }}
                        <img src="{{ asset($logos->filename) }}">
                        {{ $logos->title }}
                    </div>
                    <div class="card-footer">
                        {!! Form::open(['action' => ['LogoController@vote_add', $logos->id]]) !!}
                        {!! Form::hidden('value', '0') !!}
                        {!! Form::submit(trans('app.rate_down')) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['action' => ['LogoController@vote_add', $logos->id]]) !!}
                        {!! Form::hidden('value', '1') !!}
                        {!! Form::submit(trans('app.rate_up')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.no_rateable_logos_available') }}
                    </div>
                    <div class="card-body">
                        {{ trans('app.you_already_rated_all_logos') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection