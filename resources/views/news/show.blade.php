@extends('layouts.app')
@section('content')
    <div id="content">
        @if(count($news) > 0)
            <div id="prodpagecontainer">
                <div class="rmarchivtbl" id="rmarchivbox_news">
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
                </div>
                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>popularitäts helfer</h2>
                    <div class='content'>
                        <p>erhöhe den bekanntheitsgrad diese news und verteile folgenden link:</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly' />
                    </div>
                </div>

                @if(count($comments))
                <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                    <h2>kommentare</h2>
                    @foreach($comments as $comment)
                    <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                        <div class='content'>
                            {!! $comment->comment_html !!}
                        </div>
                        <div class='foot'>
                            @if($comment->vote_up == 0 and $comment->vote_down == 0)
                                <span class='vote neut'>neut</span>
                            @else
                                @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                    <span class='vote up'>up</span>
                                @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                    <span class='vote down'>down</span>
                                @endif
                            @endif

                            <span class='tools' data-cid='{{ $news->id }}'></span> hinzugefügt am {{ $comment->created_at }} von <a href='{{ url('user', $comment->user_id) }}' class='user'>{{ $comment->name }}</a>
                            <a href='{{ url('users', $comment->user_id) }}' class='usera' title="{{ $comment->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}' alt="{{ $comment->name }}" class='avatar' />
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <div class='rmarchivtbl' id='rmarchivbox_prodsubmitchanges'>
                    <h2>kommentarhinweise</h2>
                    <div class='content'>
                        <p>WIP</p>
                    </div>
                </div>

                @if(Auth::check())
                <div class='rmarchivtbl' id='rmarchivbox_prodpost'>
                    <h2>kommentar hinzufügen</h2>
                    <form action='/?page=submit' method='post' id='frmProdComment'>
                        <div class='content'>
                            <input type='hidden' name='gameid' value='--data.id--'>
                            <input type='hidden' name='posttype' value='comment'>
                            <input type='hidden' name='commenttype' value='game'>
                            {% if data.canrate == 'true' %}
                            <div id='prodvote'>
                                hier wird dieses spiel bewertet:<br>
                                dieses spiel<br>
                                <input type='radio' name='rating' id='ratingrulez' value='up' />
                                <label for='ratingrulez'>ist super</label>
                                <input type='radio' name='rating' id='ratingpig' value='neut' checked='true' />
                                <label for='ratingpig'>ist ok</label>
                                <input type='radio' name='rating' id='ratingsucks' value='down' />
                                <label for='ratingsucks'>ist scheiße</label>
                            </div>
                            {% endif %}
                            <textarea name='comment' id='comment'></textarea>
                            <div><a href='/?page=faq#markdown'><b>markown</b></a> kann benutzt werden</div>
                        </div>
                        <div class='foot'>
                            <input type='submit' value='Submit' id='submit'>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        @else
            <h2>zu dieser id existiert keine news</h2>
        @endif
    </div>
@endsection