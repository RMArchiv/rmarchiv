@extends('layouts.app')
@section('pagetitle', trans('news.create.title'))
@section('content')
    <div id="content">
        <form action="{{ url('/news') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitnews">
                <h2>{{ trans('news.create.title') }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('news.create.error') }}</h2>
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
                            <label for="title">{{ trans('news.create.news_title') }}:</label>
                            <input name="title" id="title" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                            @include('_partials.markdown_editor')
                        <div class="row" id="row_msg">
                            <label for="cat">{{ trans('news.create.category') }}:</label>
                            <input name="cat" id="cat" value="" placeholder="allgemein"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="{{ trans('news.create.send') }}">
                </div>
            </div>
        </form>
    </div>
@endsection