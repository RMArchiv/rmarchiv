@extends('layouts.app')
@section('pagetitle', 'nachricht erstellen')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>erstelle eine neue privatnachricht</h1>
                {!! Breadcrumbs::render('messages.create') !!}
            </div>
        </div>
        @if(Auth::check())
        <div class="row">
            <div class="well">
                {!! Form::open(['route' => 'messages.store', 'class' => 'form-horizontal']) !!}
                <form class="form-horizontal">
                    <fieldset>
                        <legend>nachricht erstellen</legend>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">titel</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputEmail" name="subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="textArea" class="col-lg-2 control-label">nachricht</label>
                            <div class="col-lg-10">
                                @include('_partials/markdown_editor')
                                <span class="help-block">hier kann markdown genutzt werden.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="select" class="col-lg-2 control-label">empfänger</label>
                            <div class="col-lg-10">
                                <div class="checkbox">
                                    @foreach($users as $user)
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="checkbox" autocomplete="off" name="recipients[]"> {{ $user->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">senden</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                {!! Form::close() !!}
            </div>
        </div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">du bist nicht angemeldet.</div>
                <div class="panel-body">
                    du bist nicht angemeldet.<br>
                    um einen thread erstellen zu können, <a href="{{ url('login') }}">logge</a> dich ein.<br>
                    wenn du keinen account hast, <a href="{{ url('register') }}">registriere</a> dich doch einfach.
                </div>
            </div>
        @endif
    </div>
@stop