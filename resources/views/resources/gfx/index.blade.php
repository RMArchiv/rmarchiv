@extends('layouts.app')
@section('content')
    @include('resources._partials.nav')
    <x-resource.table :type="'gfx'" :title="trans('app.gfx')" :resources="$resources" :commentsmax="$commentsmax" />
@endsection