@extends('layouts.app')
@section('pagetitle', $thread->subject)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ $thread->subject }}</h1>
                    {!! Breadcrumbs::render('messages.show', $thread) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">{{ $messages->links('vendor.pagination.bootstrap-4') }}</div>
                    <div class="card-body">
                        <ul class="media-list">
                            @foreach($messages as $post)
                                <li class="media">
                                    <div class="media-body active">
                                        <div class="media">
                                            <a class="float-start me-3" href="#">
                                                <img width="32px" class="media-object img-rounded" src="//{{ config('app.avatar_path') }}?size=160&gender=male&id={{ $post->user->id }}">
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
                    <div class="card-footer">{{ $messages->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <form method="POST" action="{{route('messages.update', $thread->id)}}">
                @method("PUT")
                @csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{ trans('app.post_a_reply') }}
                        </div>
                        <div class="card-body">
                            @include('_partials.markdown_editor')
                        </div>

                        <div class="card-body d-flex flex-column gap-2">
                            <div>{{ trans("app.recipients") . ":" }}
                            @foreach(App\Models\MessengerParticipant::whereThreadId($thread->id)->whereNotIn("user_id", [Auth::id()])->get() as $pp)
                                @php $user = \App\Models\User::whereId($pp->user_id)->first() @endphp
                                <a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">
                                    <img width="16px" class="img-rounded" src='//{{ config('app.avatar_path') }}?size=16&gender=male&id={{ $user->id }}' alt="{{ $user->name }}"/>
                                </a> <a href='{{ url('users', $user->id) }}' class='user'>{{ $user->name }}</a>
                            @endforeach
                            </div>
                            {{ trans("app.add_additional_users")}}
                            <x-messenger.recipients :users="$users" :latestUsers="array()" />
                        </div>
                        <div class="card-footer">
                            <button type="submit" value="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
                        </div>
                    </div>
                </div>
        </form>
        </div>
    </div>
@endsection