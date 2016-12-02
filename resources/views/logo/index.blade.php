@extends('layouts.app')
@section('pagetitle', 'logos bewerten')
@section('content')
    <div id="content">
        <div class="rmarchivtbl">
            @if(count($logo) > 0)
            <h2>logo bewerten</h2>
            <div class="content">
                bewerte folgendes logo:<br>
                <br>
                <img src="{{ asset($logo->filename) }}">
                <br>
                {{ $logo->title }} - {{ $logo->id }}
                <br>
                {!! Form::open(['action' => ['LogoController@vote_add', $logo->id]]) !!}
                    {!! Form::hidden('value', '0') !!}
                    {!! Form::submit('Schlecht') !!}
                {!! Form::close() !!}

                {!! Form::open(['action' => ['LogoController@vote_add', $logo->id]]) !!}
                    {!! Form::hidden('value', '1') !!}
                    {!! Form::submit('Gut') !!}
                {!! Form::close() !!}
            </div>
            @else
                <h2>keine bewertbaren logos</h2>
                <div class="content">
                    du hast schon alle logos bewertet. <br>füge neue hinzu oder warte bis dies ein anderer macht.
                </div>
            @endif
        </div>
    </div>
@endsection