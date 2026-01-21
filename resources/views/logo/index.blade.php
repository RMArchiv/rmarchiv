@extends('layouts.app')
@section('pagetitle', trans('app.rate_logos'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.rate_logos') }}</h1>
                    {!! Breadcrumbs::render('logorating') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($logos)
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.rate_logos') }}
                    </div>
                    <div class="card-body">
                        {{ trans('app.please_rate_this_logo') }}
                            <img class="w-100" src="{{ route('logo.show', $logos->id) }}">
                        {{ $logos->title }}
                    </div>
                    <div class="card-footer d-flex gap-2">
                        <form method="POST" action="{{ action('LogoController@vote_add', $logos->id) }}">
                            @csrf
                        <input type="hidden" name='value' value="0">
                        <x-common.iconbutton type="submit" class="btn-primary" showtextfrom="lg" icon="fa fa-thumbs-down">{{ trans('app.rate_down') }}</x-common.iconbutton>
                        </form>
                        <form method="POST" action="{{ action('LogoController@vote_add', $logos->id) }}">
                            @csrf
                        <input type="hidden" name='value' value="1">
                        <x-common.iconbutton type="submit" class="btn-primary" showtextfrom="lg" icon="fa fa-thumbs-up">{{ trans('app.rate_up') }}</x-common.iconbutton>
                        </form>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.no_rateable_logos_available') }}
                    </div>
                    <div class="card-body">
                        {{ trans('app.you_already_rated_all_logos') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection