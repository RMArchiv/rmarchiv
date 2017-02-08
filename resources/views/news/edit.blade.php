@extends('layouts.app')
@section('pagetitle', 'news bearbeiten')
@section('content')
    <div id="content">
        <div id="prodpagecontainer">
        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            {!! method_field('patch') !!}
            {{ csrf_field() }}

            <div  class="rmarchivtbl rmarchivbox_newsbox" id="rmarchivbox_prodmain">
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
                            <input name="title" id="title" value="{{ $news->title }}"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row" id="row_message">
                            <label for="msg">beschreibung:</label>
                            <textarea name="msg" id="msg" maxlength="9999" rows="10" placeholder="Newsbeitrag">{{ $news->news_md }}</textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
                        </div>
                        <script type="text/javascript">
                            $(function() {
                                $('textarea').inlineattachment({
                                    uploadUrl: 'http://rmarchiv.de/attachment/upload',
                                });
                            });
                        </script>
                        <div class="row" id="row_msg">
                            <label for="cat">kategorie:</label>
                            <input name="cat" id="cat" value="{{ $news->news_category }}" placeholder="allgemein"/>
                            <span> [<span class="req">req</span>]</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="news speichern">
                </div>
            </div>
        </form>

        <div class="rmarchivtbl rmarchivbox_newsbox" id="rmarchivbox_prodmain">
            <h2>live preview</h2>
            <div class="content" id="preview_box">

            </div>
            <script>
                var reader = new commonmark.Parser();
                var writer = new commonmark.HtmlRenderer();
                var parsed = reader.parse(document.getElementById('msg').value);
                var result = writer.render(parsed);
                document.getElementById('preview_box').innerHTML = result;

                document.getElementById('msg').onkeyup = function() {
                    var reader = new commonmark.Parser();
                    var writer = new commonmark.HtmlRenderer();
                    var parsed = reader.parse(document.getElementById('msg').value);
                    var result = writer.render(parsed);
                    document.getElementById('preview_box').innerHTML = result;
                }
            </script>

        </div>
    </div>
    </div>
@endsection