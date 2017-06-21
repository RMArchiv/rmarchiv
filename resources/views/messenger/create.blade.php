@extends('layouts.app')
@section('pagetitle', trans('app.create_new_pm'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.create_new_pm') }}</h1>
                {!! Breadcrumbs::render('messages.create') !!}
            </div>
        </div>
        @if(Auth::check())
        <div class="row">
            <div class="well">
                {!! Form::open(['route' => 'messages.store', 'class' => 'form-horizontal']) !!}
                <form class="form-horizontal">
                    <fieldset>
                        <legend>{{ trans('app.create_new_pm') }}</legend>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">{{ trans('app.subject') }}</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputEmail" name="subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="textArea" class="col-lg-2 control-label">{{ trans('app.message') }}</label>
                            <div class="col-lg-10">
                                @include('_partials/markdown_editor')
                                <span class="help-block">{{ trans('app.markdown_is_usable_here') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="select" class="col-lg-2 control-label">{{ trans('app.recipients') }}</label>
                            <div class="col-lg-10">
                                <div class="checkbox">
                                    @foreach($users as $user)
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="checkbox" autocomplete="off" name="recipients[]" value="{{ $user->id }}"> {{ $user->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                {!! Form::close() !!}
            </div>
        </div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.login_needed') }}</div>
                <div class="panel-body">
                    {{ trans('app.login_needed_to_post') }}
                </div>
            </div>
        @endif
    </div>
@stop