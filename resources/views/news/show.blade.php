@extends('layouts.app')
@section('pagetitle', 'news: '.$news->title)
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
                        {{ trans('app.news.show.submit_by') }} <a href='{{ url('users', $news->user_id) }}'>{{ $news->name }}</a> :: <time datetime='{{ $news->created_at }}' title='{{ $news->created_at }}'>{{ \Carbon\Carbon::parse($news->created_at)->diffForHumans() }}</time>
                    </div>
                    @if(Auth::check())
                            <div class="foot">
                                @if(Auth::user()->settings->is_admin)
                                    <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                        <form action="{{ url('/news', $news->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                        [{{ trans('app.news.show.delete') }}]
                                    </a> ::
                                @endif
                                @if(Auth::user()->settings->is_admin or Auth::user()->settings->is_moderator)
                                    @if($news->approved == 1)
                                        <a href="{{ url('news/'.$news->id.'/approve/0') }}">[{{ trans('app.news.show.disapprove') }}]</a>
                                    @else
                                        <a href="{{ url('news/'.$news->id.'/approve/1') }}">[{{ trans('app.news.show.approve') }}]</a>
                                    @endif
                                @endif
                            </div>
                    @endif
                </div>

                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>{{ trans('app.news.popularity_helper.title') }}</h2>
                    <div class='content'>
                        <p>{{ trans('app.news.popularity_helper.msg') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly' />
                    </div>
                </div>

                @if($comments->count() > 0)
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>kommentare</h2>
                        @foreach($comments as $comment)
                        <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                            <div class='content'>
                                {!! $comment->comment_html !!}
                            </div>
                            <div class='foot'>
                                    @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                        <span class='vote up'>up</span>
                                    @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                        <span class='vote down'>down</span>
                                    @endif

                                <span class='tools' data-cid='{{ $news->id }}'></span> hinzugefügt am {{ $comment->created_at }} von <a href='{{ url('user', $comment->user_id) }}' class='user'>{{ $comment->name }}</a>
                                <a href='{{ url('users', $comment->user_id) }}' class='usera' title="{{ $comment->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}' alt="{{ $comment->name }}" class='avatar' />
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>kommentare</h2>
                        <div class="comment">
                            <div class="content">
                                Es sind noch keine Kommentare vorhanden.
                            </div>
                        </div>
                    </div>
                @endif

                <div class='rmarchivtbl' id='rmarchivbox_prodsubmitchanges'>
                    <h2>kommentarhinweise</h2>
                    <div class='content'>
                        <p>{{ trans('app.comments.tip1') }}</p>
                        <p>{{ trans('app.comments.tip2') }}</p>
                        <p>{{ trans('app.comments.tip3') }}</p>
                        <p>{{ trans('app.comments.tip4') }}</p>
                    </div>
                </div>

                @if(Auth::check())
                <div class='rmarchivtbl' id='rmarchivbox_prodpost'>
                    <h2>kommentar hinzufügen</h2>
                    {!! Form::open(['action' => ['CommentController@add']]) !!}
                    {!! Form::hidden('content_id', $news->id) !!}
                    {!! Form::hidden('content_type', 'news') !!}
                        <div class='content'>
                            {{ CheckRateable::checkRateable('news', $news->id, Auth::id()) }}
                            @if(CheckRateable::checkRateable('news', $news->id, Auth::id()) === true)
                            <div id='prodvote'>
                                hier wird diese news bewertet:<br>
                                diese news<br>
                                <input type='radio' name='rating' id='ratingrulez' value='up' />
                                <label for='ratingrulez'>ist super</label>
                                <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked' />
                                <label for='ratingpig'>ist ok</label>
                                <input type='radio' name='rating' id='ratingsucks' value='down' />
                                <label for='ratingsucks'>ist scheiße</label>
                            </div>
                            @endif
                            <textarea name='comment' id='comment'></textarea>
                            <div><a href='/?page=faq#markdown'><b>markown</b></a> kann benutzt werden</div>
                        </div>
                        <div class='foot'>
                            <input type='submit' value='Submit' id='submit'>
                        </div>
                    {!! Form::close() !!}
                </div>
                @endif
            </div>
        @else
            <h2>zu dieser id existiert keine news</h2>
        @endif
    </div>
@endsection