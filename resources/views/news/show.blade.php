@extends('layouts.app')
@section('content')
    <div id="content">
        <div class="rmarchivtbl" id="rmarchivbox_news">
            @if(count($news) > 0)
            <h2>{{ $news->title }}</h2>
            <div class="content">
                {!! $news->news_html !!}
            </div>
            <div class="foot">
                Eingesendet von <a href='{{ url('users', $news->user_id) }}'>{{ $news->name }}</a> am {{ $news->created_at }}
            </div>
            @if(Auth::check())
                    <div class="foot">
                        @if(Auth::user()->settings->is_admin)
                            <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                <form action="{{ url('/news', $news->id) }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                                [löschen]
                            </a> ::
                        @endif
                        @if(Auth::user()->settings->is_admin or Auth::user()->settings->is_moderator)
                            @if($news->approved == 1)
                                <a href="{{ url('news/'.$news->id.'/approve/0') }}">[sperren]</a>
                            @else
                                <a href="{{ url('news/'.$news->id.'/approve/1') }}">[erlauben]</a>
                            @endif
                        @endif
                    </div>
            @endif
            @else
                <h2>zu dieser id existiert keine news</h2>
            @endif
        </div>
    </div>
@endsection