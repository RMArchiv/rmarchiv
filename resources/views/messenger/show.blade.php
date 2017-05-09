@extends('layouts.app')
@section('pagetitle', $thread->subject)
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ $thread->subject }}</h1>
                {!! Breadcrumbs::render('messages.show', $thread) !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $messages->links('vendor.pagination.bootstrap-4') }}</div>
                <div class="panel-body">
                    <ul class="media-list">
                        @foreach($messages as $post)
                            <li class="media">
                                <div class="media-body active">
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img width="32px" class="media-object img-rounded" src="http://ava.rmarchiv.de/?size=160&gender=male&id={{ $post->user->id }}">
                                        </a>
                                        <div class="media-body">
                                            {!! \App\Helpers\InlineBoxHelper::GameBox(Markdown::convertToHtml($post->body)) !!}
                                            <br>
                                            <small class="text-muted">
                                                <a href='{{ url('users', $post->user->id) }}' class='user'>{{ $post->user->name }}</a>
                                                <span> • </span>
                                                <a href='{{ route('board.thread.show', [$post->thread->id]) }}#c{{ $post->id }}'><time datetime='{{ $post->created_at }}' title='{{ $post->created_at }}'>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</time></a>
                                            </small>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="panel-footer">{{ $messages->links('vendor.pagination.bootstrap-4') }}</div>
            </div>
        </div>
        <div class="row">
            {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    poste eine antwort
                </div>
                <div class="panel-body">
                    @include('_partials.markdown_editor')
                </div>
                <div class="panel-body">
                    weitere user hinzufügen:
                    @if($users->count() > 0)
                        <div class="checkbox">
                            @foreach($users as $user)
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default">
                                        <input type="checkbox" autocomplete="off" name="recipients[]" value="{{ $user->id }}"> {{ $user->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="panel-footer">
                    <button type="submit" value="submit" class="btn btn-primary">senden</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection