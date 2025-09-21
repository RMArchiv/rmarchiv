@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card successbox">
            <h2 class="card-header">{!! $title !!}</h2>
            <div class="card-body">
                <strong>{!! $msg !!}</strong>
            </div>
            <div class="card-footer">
                <a href="{!! $redirect_to !!}">{!! $redirect !!}</a>
            </div>
        </div>
    </div>
@endsection
