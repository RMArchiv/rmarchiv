@extends('layouts.app')
@section('pagetitle', trans('news.title'))
@section('content')
    <div id="content">
        @if(count($news) > 0)
        <div id="prodpagecontainer">
            <h2>{{ trans('news.title') }}</h2>
            <table id="rmarchivbox_newslist" class="boxtable pagedtable">
                <thead>
                <tr class="sortable">
                    <th>{{ trans('news.index.user') }}</th>
                    <th>{{ trans('news.index.created_at') }}</th>
                    <th>{{ trans('news.index.news_title') }}</th>
                    <th>{{ trans('news.index.comments') }}</th>
                </tr>
                </thead>
                @foreach($news as $new)
                    @if($new->approved == 1)
                        <tr>
                            <td>
                                <a href="{{ url('/user', $new->user_id) }}" class="usera" title="{{ $new->name }}">
                                    <img src="http://ava.rmarchiv.de/?gender=male&amp;id={{ $new->user_id }}" alt="{{ $new->name }}" class="avatar">
                                </a> <a href="{{ url('/user', $new->user_id) }}" class="user">{{ $new->name }}</a>
                            </td>
                            <td><time datetime='{{ $new->created_at }}' title='{{ $new->created_at }}'>{{ \Carbon\Carbon::parse($new->created_at)->diffForHumans() }}</time></td>
                            <td><a href="{{ url('/news', $new->id) }}">{{ $new->title }}</a></td>
                            <td>{{ $new->counter or 0 }}</td>
                        </tr>
                    @else
                        @permission(('edit-news'))
                            <tr style="color: #ff4f4f !important;">
                                <td>
                                    <a href="{{ url('/user', $new->user_id) }}" class="usera" title="{{ $new->name }}">
                                        <img src="http://ava.rmarchiv.de/?gender=male&amp;id={{ $new->user_id }}" alt="{{ $new->name }}" class="avatar">
                                    </a> <a href="{{ url('/user', $new->user_id) }}" class="user">{{ $new->name }}</a>
                                </td>
                                <td>{{ $new->created_at }}</td>
                                <td><a href="{{ url('/news', $new->id) }}">{{ $new->title }}</a></td>
                                <td>{{ $new->counter or 0 }}</td>
                            </tr>
                        @endpermission
                    @endif
                @endforeach
            </table>
        </div>

        @else
            <h2>{{ trans('news.index.no_news') }}</h2>
        @endif
    </div>
@endsection