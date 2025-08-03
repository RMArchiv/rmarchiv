@extends('layouts.app')
@section('content')
    @include('resources._partials.nav')
    <div id="content">
        <x-resource.table :type="'sfx'" :title="trans('app.sfx')" :resources="$resources" :commentsmax="$commentsmax" />
    </div>
@endsection