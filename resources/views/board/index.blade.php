@extends('layouts.app')
@section('pagetitle', trans('app.board_overview'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.board_overview') }}</h1>
                {!! Breadcrumbs::render('forums') !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Organisatorisches
                </div>
                <ul class="list-group">
                    @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 1])
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    RPG Maker
                </div>
                <ul class="list-group">
                    @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 4])
                    @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 5])
                    @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 2])
                    @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 3])
                    @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 6])
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Community
                </div>
                <ul class="list-group">
                    @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 7])
                    @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 8])
                </ul>
            </div>
        </div>

        <div class="row">
            @if(Auth::check())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.create_thread') }}
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['board.thread.store'], 'id' => 'frmBBSPost']) !!}
                        <div class='content'>
                            <label for='topic'>{{ trans('app.topic') }}</label>
                            <input name='topic' id='topic'/>
                            <label for='category'>{{ trans('app.category') }}</label>
                            <select name='category' id='category'>
                                @foreach($cats as $cat)
                                    <option value='{{ $cat->id }}'>{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            <label for='message'>{{ trans('app.message') }}</label>
                            @include('_partials.markdown_editor')
                            <div>{!! trans('app.markdown_is_usable_here') !!}</div>
                        </div>
                        <div class='foot'>
                            <input type='submit' value='{{ trans('app.submit') }}' id='submit'></div>
                        {!! Form::close() !!}
                    </div>
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.login_needed') }}
                    </div>
                    <div class="panel-body">
                        {{ trans('app.login_needed_to_post') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection