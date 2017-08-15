@extends('layouts.app')
@section('pagetitle', trans('app.private_massages'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.private_massages') }}
                    <div class='btn-toolbar pull-right'>
                        <div class='btn-group'>
                            <a role="button" href="{{ action('MessagesController@create') }}" class="btn btn-primary"><span class="fa fa-plus"></span></a>
                        </div>
                    </span>
                </h1>
                {!! Breadcrumbs::render('messages') !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $threads->links('vendor.pagination.bootstrap-4') }}
                </div>
                <ul class="list-group">
                    @foreach($threads as $thread)
                        <li class="list-group-item media" style="margin-top: 0px;">
                            <a class="pull-right" href="{{ route('messages.show', $thread->id) }}"><span class="badge">{{ App\Models\MessengerMessage::whereThreadId($thread->id)->count() }}</span></a>
                            <a class="pull-left" href="{{ url('users', $thread->creator()->id) }}"><img class="media-object img-rounded" width="42px" src="//{{ config('app.avatar_path') }}?size=42&gender=male&id={{ $thread->creator()->id }}" alt="{{ $thread->creator()->name }}"></a>
                            <div class="thread-info">
                                <div class="media-heading">
                                    @if($thread->closed == 1)
                                        <i class="fa fa-lock text-danger"></i>
                                    @endif
                                    @if(\App\Models\BoardPoll::whereThreadId($thread->id)->count() != 0)
                                        <i class="fa fa-signal fa-rotate-270"></i>
                                    @endif
                                        <a href="{{ route('messages.show', $thread->id) }}">
                                            <span @if($thread->isUnread($currentUserId) === true) style="font-weight: bold;" @endif>
                                                @if($thread->subject == '')
                                                    {{ trans('app.no_subject') }}
                                                @else
                                                    {{ $thread->subject }}
                                                @endif
                                            </span>
                                        </a>
                                </div>
                                <div class="media-body" style="font-size: 12px;">
                                    @if($thread->isUnread($currentUserId) === true)
                                    <div class="pull-right">
                                        <span class="label label-danger">
                                                {{ trans('app.new_message_available') }}
                                        </span>
                                    </div>
                                    @endif
                                    {{ trans('app.created_at') }}
                                    <time datetime='{{ $thread->created_at }}' title='{{ $thread->created_at }}'>{{ \Carbon\Carbon::parse($thread->created_at)->diffForHumans() }}</time>
                                    <span> • </span>
                                    {{ trans('app.last_reply_at') }}
                                    <time datetime='{{ $thread->updated_at }}' title='{{ $thread->updated_at  }}'>{{ \Carbon\Carbon::parse($thread->updated_at)->diffForHumans() }}</time>
                                    <span> • </span>
                                    {{ trans('app.participants') }}:
                                    @foreach(App\Models\MessengerParticipant::whereThreadId($thread->id)->get() as $pp)
                                        @php $user = \App\Models\User::whereId($pp->user_id)->first() @endphp
                                    <a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">
                                        <img width="16px" class="img-rounded" src='//{{ config('app.avatar_path') }}?size=16&gender=male&id={{ $user->id }}' alt="{{ $user->name }}"/>
                                    </a> <a href='{{ url('users', $user->id) }}' class='user'>{{ $user->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="panel-footer">
                    {{ $threads->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection