@extends('layouts.app')
@section('content')
    @if(Auth::check())
        @if(Auth::user()->id == $post->user_id or Auth::user()->can('mod-threads'))
            <div id="content">
                <form action="{{ route('board.vote.create', [$post->thread_id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="rmarchivtbl" id="rmarchivbox_submitnews" style="width: 60%">
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

                            @include('_partials.markdown_editor', ['edit_text' => $post->content_md])
                        </div>
                        <div class="foot">
                            <input type="submit" value="speichern">
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div id="content">
                <div class="rmarchivtbl">
                    Das darfst du nicht!
                </div>
            </div>
        @endif

    @else
        <div id="content">
            <div class="rmarchivtbl">
                Das darfst du nicht!
            </div>
        </div>
    @endif
@endsection