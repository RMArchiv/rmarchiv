@extends('layouts.app')
@section('pagetitle', trans('app.create_news'))
@section('content')
    <div id="content">
        <form action="{{ url('/news') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitnews">
                <h2>{{ trans('app.create_news') }}</h2>

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

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_type">
                            <label for="title">{{ trans('app.news_title') }}:</label>
                            <input name="title" id="title" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                            @include('_partials.markdown_editor')
                        <div class="row" id="row_msg">
                            <label for="cat">{{ trans('app.news_category') }}:</label>
                            <input name="cat" id="cat" value="" placeholder="allgemein"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="{{ trans('app.submit') }}">
                </div>
            </div>
        </form>
    </div>
@endsection