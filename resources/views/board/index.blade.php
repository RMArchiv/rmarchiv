@extends('layouts.app')
@section('pagetitle', trans('app.board_overview'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.board_overview') }}</h1>
                    {!! Breadcrumbs::render('forums') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        Organisatorisches
                    </div>
                    <ul class="list-group">
                        @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 1])
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
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
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        Community
                    </div>
                    <ul class="list-group">
                        @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 7])
                        @include('board._partials.overview_cat_row', ['cats' => $cats, 'id' => 8])
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
            @if(Auth::check())
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.create_thread') }}
                    </div>
                    <div class="card-body">
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
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.login_needed') }}
                    </div>
                    <div class="card-body">
                        {{ trans('app.login_needed_to_post') }}
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
@endsection