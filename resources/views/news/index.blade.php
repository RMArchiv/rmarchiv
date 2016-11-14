@extends('layouts.app')
@section('content')
    <div id="content">
        @if(count($news) > 0)
        <div id="prodpagecontainer">
            <h2>News</h2>
            <table id="rmarchivbox_newslist" class="boxtable pagedtable">
                <thead>
                <tr class="sortable">
                    <th>user</th>
                    <th>datum</th>
                    <th>titel</th>
                    <th>kommentare</th>
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
                            <td>{{ $new->created_at }}</td>
                            <td><a href="{{ url('/news', $new->id) }}">{{ $new->title }}</a></td>
                            <td>{{ $new->counter or 0 }}</td>
                        </tr>
                    @else
                        @if(Auth::user()->settings->is_admin or Auth::user()->settings->is_moderator)
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
                        @endif
                    @endif
                @endforeach
            </table>
        </div>

        @else
            <h2>es sind noch keine news vorhanden. bitte sende doch welche ein.</h2>
        @endif
    </div>
@endsection