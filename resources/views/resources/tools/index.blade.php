@extends('layouts.app')
@section('content')
    @include('resources._partials.nav')
    <div id="content">
        <x-resource.table :type="'tools'" :title="trans('app.tools')" :resources="$resources" :commentsmax="$commentsmax" />
    </div>
@endsection