@extends('layouts.app')
@section('pagetitle', trans('app.create_news'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.create_news') }}</h1>
                    {!! Breadcrumbs::render('news.create') !!}
                </div>
            </div>
        </div>
        @if (count($errors) > 0))
        <div class="rmarchivtbl errorbox">
            <h2>{{ trans('app.create_news_error') }}</h2>
            <div class="content">
                @foreach ($errors->all() as $error)
                    <strong>{{ $error }}</strong>
                @endforeach
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('/news') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            {{ trans('app.create_news') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group" id="row_type">
                                <label for="title">{{ trans('app.news_title') }}:</label>
                                <input class="form-control" name="title" id="title" value=""/>
                                <span> [<span class="req">req</span>]</span>
                            </div>
                            @include('_partials.markdown_editor')
                            <div class="form-group" id="row_msg">
                                <label for="cat">{{ trans('app.news_category') }}:</label>
                                <input class="form-control" name="cat" id="cat" value="" placeholder="allgemein"/>
                                <span> [<span class="req">req</span>]</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-primary" type="submit" value="{{ trans('app.submit') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection