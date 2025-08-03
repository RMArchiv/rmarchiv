@extends('layouts.app')
@section('content')
    @include('resources._partials.nav')
    <x-resource.table :type="'gfx'" :title="trans('app.gfx') . ' -> ' . Request::route('cat')" :resources="$resources" :commentsmax="$commentsmax" />
@endsection