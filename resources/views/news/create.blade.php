@extends('layouts.app')
@section('pagetitle', 'news erstellen')
@section('content')
    <div id="content">
        <form action="{{ url('/news') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitnews">
                <h2>{{ trans('app.news.add.title') }}</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>{{ trans('app.news.add.error.title') }}</h2>
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
                            <label for="title">titel:</label>
                            <input name="title" id="title" value=""/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_message">
                            <label for="msg">Beschreibung:</label>
                            <textarea name="msg" id="msg" maxlength="9999" rows="10" placeholder="Newsbeitrag"></textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
                        </div>
                        <div class="row" id="row_msg">
                            <label for="cat">kategorie:</label>
                            <input name="cat" id="cat" value="" placeholder="allgemein"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="News einsenden">
                </div>
            </div>
        </form>
    </div>
@endsection