@extends('layouts.app')

@section('content')
    <div class="rmarchivtbl successbox">
        <h2>{!! $title !!}</h2>
        <div class="content">
            <strong>{!! $msg !!}</strong>
        </div>
        <div class="foot">
            <a href="{!! $redirect_to !!}">{!! $redirect !!}</a>
        </div>
    </div>
@endsection
