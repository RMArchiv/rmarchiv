@extends('layouts.app')
@section('content')
    <div id="content">
        <form action="{{ route('board.post.update', [$post->thread_id, $post->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl" id="rmarchivbox_submitnews">
                <h2>post bearbeiten</h2>

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
                    <input type="hidden" name="thread_id" id="thread_id" value="{{ $post->thread_id }}">
                    <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">

                    <div class="formifier">
                        <div class="row" id="row_message">
                            <label for="msg">Beschreibung:</label>
                            <textarea name="msg" id="msg" maxlength="9999" rows="10" placeholder="Post">{{ $post->content_md }}</textarea>
                            <span> [<span class="req">req</span>] Markdown!</span>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input type="submit" value="speichern">
                </div>
            </div>
        </form>
    </div>
@endsection