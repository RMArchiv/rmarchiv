@extends('layouts.app')
@section('pagetitle', trans('app.edit_news').': '.$news->title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.edit_news') }}: {{ $news->title }}</h1>
                {!! Breadcrumbs::render('news.edit', $news) !!}
            </div>
        </div>
        <div class="row">
            @if (count($errors) > 0))
            <div class="rmarchivtbl errorbox">
                <h2>{{ trans('app.edit_news_error') }}</h2>
                <div class="content">
                    @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</strong>
                    @endforeach
                </div>
            </div>
            @endif
            <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                {!! method_field('patch') !!}
                {{ csrf_field() }}

                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.edit_news') }}
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="title" class="col-lg-2 col-form-label">{{ trans('app.news_title') }}: *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="msg" class="col-lg-2 col-form-label">{{ trans('app.news') }}</label>
                            @include('_partials.markdown_editor', ['edit_text' => $news->news_md])
                        </div>
                        <div class="form-group">
                            <label for="cat" class="col-lg-2 col-form-label">{{ trans('app.news_category') }}: *</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="cat" name="cat" value="{{ $news->news_category }}">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input class="btn btn-secondary" type="submit" value="{{trans('app.submit')}}">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection