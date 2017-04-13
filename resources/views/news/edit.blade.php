@extends('layouts.app')
@section('pagetitle', trans('news.edit.title'))
@section('content')
    <div id="content">
        <div id="prodpagecontainer">
            <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                {!! method_field('patch') !!}
                {{ csrf_field() }}

                <div class="rmarchivtbl rmarchivbox_newsbox" id="rmarchivbox_prodmain">
                    <h2>{{ trans('news.edit.title') }}</h2>

                    @if (count($errors) > 0))
                    <div class="rmarchivtbl errorbox">
                        <h2>{{ trans('news.edit.error') }}</h2>
                        <div class="content">
                            @foreach ($errors->all() as $error)
                                <strong>{{ $error }}</strong>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="content">
                        <div class="formifier">
                            <div class="row" id="row_type">
                                <label for="title">{{ trans('news.edit.news_title') }}:</label>
                                <input name="title" id="title" value="{{ $news->title }}"/>
                                <span> [<span class="req">req</span>]</span>
                            </div>

                            @include('_partials.markdown_editor', ['edit_text' => $news->news_md])

                            <div class="row" id="row_msg">
                                <label for="cat">{{ trans('news.edit.category') }}:</label>
                                <input name="cat" id="cat" value="{{ $news->news_category }}" placeholder="allgemein"/>
                                <span> [<span class="req">req</span>]</span>
                            </div>
                        </div>
                    </div>
                    <div class="foot">
                        <input type="submit" value="{{ trans('news.edit.send') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection