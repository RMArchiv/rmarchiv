@extends('layouts.app')
@section('pagetitle', trans('app.webplayer').': '.$game->title)
@section('content')

{!! $index !!}

@endsection
