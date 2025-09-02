@extends('layouts.app')
@section('pagetitle', trans('app.create_new_pm'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.create_new_pm') }}</h1>
                    {!! Breadcrumbs::render('messages.create') !!}
                </div>
            </div>
        </div>
        @if (Auth::check())
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('messages.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                {{ trans('app.create_new_pm') }}
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputSubject"
                                        class="col-lg-2 col-form-label">{{ trans('app.subject') }}</label>
                                    <div class="">
                                        <input type="text" class="form-control" id="inputSubject" name="subject">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="textArea" class="col-lg-2 col-form-label">{{ trans('app.message') }}</label>
                                    <div class="">
                                        @include('_partials/markdown_editor')
                                        <span class="form-text">{{ trans('app.markdown_is_usable_here') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <x-messenger.recipients :users="$users" :latestUsers="$latestUsers" :preselect="$preselect"/>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-header">{{ trans('app.login_needed') }}</div>
                <div class="card-body">
                    {{ trans('app.login_needed_to_post') }}
                </div>
            </div>
        @endif
    </div>
@stop
