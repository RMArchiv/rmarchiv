@extends('layouts.app')
@section('pagetitle', trans('app.news'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.news') }}</h1>
                {!! Breadcrumbs::render('news') !!}
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    {{ $news->links('vendor.pagination.bootstrap-4') }}
                </div>
                <ul class="list-group">
                    @foreach($news as $item)
                        @if($item->approved == 1)
                            <li class="list-group-item media" style="margin-top: 0px;">
                                <a class="pull-right" href="{{ route('news.show', $item->id) }}"><span class="badge">{{ $item->comments->count() }}</span></a>
                                <a class="pull-left" href="{{ url('users', $item->user->id) }}"><img class="media-object img-rounded" width="42px" src="//{{ config('app.avatar_path') }}?size=42&gender=male&id={{ $item->user->id }}" alt="{{ $item->user->name }}"></a>
                                <div class="thread-info">
                                    <div class="media-heading">
                                        <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                                    </div>
                                    <div class="media-body" style="font-size: 12px;">
                                        {{ trans('app.created_at') }}
                                        <time datetime='{{ $item->created_at }}' title='{{ $item->created_at }}'>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </li>
                        @else
                            @permission(('edit-news'))
                            <li class="list-group-item active media" style="margin-top: 0px;">
                                <a class="pull-right" href="{{ route('news.show', $item->id) }}"><span class="badge">{{ $item->comments->count() }}</span></a>
                                <a class="pull-left" href="{{ url('users', $item->user->id) }}"><img class="media-object img-rounded" width="42px" src="//{{ config('app.avatar_path') }}?size=42&gender=male&id={{ $item->user->id }}" alt="{{ $item->user->name }}"></a>
                                <div class="thread-info">
                                    <div class="media-heading">
                                        <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                                        <p class="text-warning">{{ trans('app.news_not_published') }}</p>
                                    </div>
                                    <div class="media-body" style="font-size: 12px;">
                                        {{ trans('app.created_at') }}
                                        <time datetime='{{ $item->created_at }}' title='{{ $item->created_at }}'>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </li>
                            @endpermission
                        @endif
                    @endforeach
                </ul>
                <div class="card-footer">
                    {{ $news->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection