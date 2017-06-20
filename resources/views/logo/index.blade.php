@extends('layouts.app')
@section('pagetitle', trans('app.rate_logos'))
@section('content')
    <div id="content">
        <div class="rmarchivtbl">
            @if(count($logo) > 0)
                <h2>{{ trans('app.rate_logos') }}</h2>
            <div class="content">
                {{ trans('app.please_rate_this_logo') }}<br>
                <br>
                <img src="{{ asset($logo->filename) }}">
                <br>
                {{ $logo->title }} - {{ $logo->id }}
                <br>
                {!! Form::open(['action' => ['LogoController@vote_add', $logo->id]]) !!}
                    {!! Form::hidden('value', '0') !!}
                {!! Form::submit(trans('app.rate_down')) !!}
                {!! Form::close() !!}

                {!! Form::open(['action' => ['LogoController@vote_add', $logo->id]]) !!}
                    {!! Form::hidden('value', '1') !!}
                {!! Form::submit(trans('app.rate_up')) !!}
                {!! Form::close() !!}
            </div>
            @else
                <h2>{{ trans('app.no_rateable_logos_available') }}</h2>
                <div class="content">
                    {{ trans('app.you_already_rated_all_logos') }}
                </div>
            @endif
        </div>
    </div>
@endsection