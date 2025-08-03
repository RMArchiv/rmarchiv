@extends('layouts.app')
@section('content')
    @include('resources._partials.nav')
    <div id="content">
        <x-resource.table :type="'scripts'" :title="trans('app.scripts') . ' -> ' . Request::route('cat')" :resources="$resources" :commentsmax="$commentsmax" />
    </div>
@endsection