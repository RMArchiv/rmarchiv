@extends('layouts.app')
@section('pagetitle', trans('app.resources_overview'))
@section('content')
    @include('resources._partials.nav')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.resources_overview') }}</h1>
                    {!! Breadcrumbs::render('ressources') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <x-resource.table :title="$title" :resources="$resources" :commentsmax="$commentsmax" />
            </div>
        </div>
    </div>

@endsection
