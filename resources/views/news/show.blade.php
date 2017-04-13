@extends('layouts.app')
@section('pagetitle', trans('news.show.title').': '.$news->title)
@section('content')
    <div id="content">
        @if(count($news) > 0)
            <div id="prodpagecontainer">
                <div class="rmarchivtbl rmarchivbox_newsbox" id="rmarchivbox_prodmain">
                    <h2>
                        {{ $news->title }}
                    </h2>
                    <div class="content markdown">
                        {!! \App\Helpers\InlineBoxHelper::GameBox($news->news_html) !!}
                    </div>
                    <div class="foot">
                        {{ trans('news.show.submit_by') }} <a href='{{ url('users', $news->user_id) }}'>{{ $news->name }}</a> :: <time datetime='{{ $news->created_at }}' title='{{ $news->created_at }}'>{{ \Carbon\Carbon::parse($news->created_at)->diffForHumans() }}</time>
                    </div>
                    @if(Auth::check())
                            <div class="foot">
                                @if(Auth::user()->settings->is_admin)
                                    <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                        <form action="{{ url('/news', $news->id) }}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                        [{{ trans('news.show.delete') }}]
                                    </a> ::
                                @endif
                                @permission(('edit-news'))
                                    @if($news->approved == 1)
                                        <a href="{{ url('news/'.$news->id.'/approve/0') }}">[{{ trans('news.show.disapprove') }}]</a>
                                    @else
                                        <a href="{{ url('news/'.$news->id.'/approve/1') }}">[{{ trans('news.show.approve') }}]</a>
                                    @endif
                                @endpermission
                                @permission(('edit-news'))
                                :: [<a href="{{ action('NewsController@edit', $news->id) }}">{{ trans('news.show.edit') }}</a>]
                                @endpermission
                            </div>
                    @endif
                </div>

                <div class='rmarchivtbl' id='rmarchivbox_prodpopularityhelper'>
                    <h2>{{ trans('news.show.popularity_helper_title') }}</h2>
                    <div class='content'>
                        <p>{{ trans('news.show.popularity_helper_msg') }}</p>
                        <input type='text' value='{{ Request::fullUrl() }}' size='50' readonly='readonly' />
                    </div>
                </div>

                @if($comments->count() > 0)
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>{{ trans('news.show.comments') }}</h2>
                        @foreach($comments as $comment)
                        <div class='comment cite-{{ $comment->user_id }}' id='c{{ $comment->id }}'>
                            <div class='content markdown'>
                                {!! \App\Helpers\InlineBoxHelper::GameBox($comment->comment_html) !!}
                            </div>
                            <div class='foot'>
                                    @if($comment->vote_up == 1 and $comment->vote_down == 0)
                                        <span class='vote up'>{{ trans('news.show.voteup') }}</span>
                                    @elseif($comment->vote_up == 0 and $comment->vote_down == 1)
                                        <span class='vote down'>{{ trans('news.show.votedown') }}</span>
                                    @endif

                                <span class='tools' data-cid='{{ $news->id }}'></span> {{ trans('news.show.created_at') }} {{ $comment->created_at }} {{ trans('news.show.by') }} <a href='{{ url('user', $comment->user_id) }}' class='user'>{{ $comment->name }}</a>
                                <a href='{{ url('users', $comment->user_id) }}' class='usera' title="{{ $comment->name }}"><img src='http://ava.rmarchiv.de/?gender=male&id={{ $comment->user_id }}' alt="{{ $comment->name }}" class='avatar' />
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class='rmarchivtbl' id='rmarchivbox_prodcomments'>
                        <h2>{{ trans('news.show.comments') }}</h2>
                        <div class="comment">
                            <div class="content">
                                {{ trans('news.show.no_comments') }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class='rmarchivtbl' id='rmarchivbox_prodsubmitchanges'>
                    <h2>{{ trans('news.show.comment_rules') }}</h2>
                    <div class='content'>
                        <p>{{ trans('news.show.comment_tip1') }}</p>
                        <p>{{ trans('news.show.comment_tip2') }}</p>
                        <p>{{ trans('news.show.comment_tip3') }}</p>
                        <p>{{ trans('news.show.comment_tip4') }}</p>
                    </div>
                </div>

                @if(Auth::check())
                <div class='rmarchivtbl' id='rmarchivbox_prodpost'>
                    <h2>{{ trans('news.show.add_comment') }}</h2>
                    {!! Form::open(['action' => ['CommentController@add']]) !!}
                    {!! Form::hidden('content_id', $news->id) !!}
                    {!! Form::hidden('content_type', 'news') !!}
                        <div class='content'>
                            {{ \App\Helpers\CheckRateableHelper::checkRateable('news', $news->id, Auth::id()) }}
                            @if(\App\Helpers\CheckRateableHelper::checkRateable('news', $news->id, Auth::id()) === true)
                            <div id='prodvote'>
                                {{ trans('news.show.rate') }}:<br>
                                <input type='radio' name='rating' id='ratingrulez' value='up' />
                                <label for='ratingrulez'>{{ trans('news.show.voteup') }}</label>
                                <input type='radio' name='rating' id='ratingpig' value='neut' checked='checked' />
                                <label for='ratingpig'>{{ trans('news.show.vote_neut') }}</label>
                                <input type='radio' name='rating' id='ratingsucks' value='down' />
                                <label for='ratingsucks'>{{ trans('news.show.votedown') }}</label>
                            </div>
                            @endif
                            @include('_partials.markdown_editor')
    <div><a href='/?page=faq#markdown'>{{ trans('news.show.markdown') }}</a></div>
</div>
<div class='foot'>
    <input type='submit' value='Submit' id='submit'>
</div>
{!! Form::close() !!}
</div>
@endif
</div>
@else
<h2>{{ trans('news.show.no_id') }}</h2>
@endif
</div>
@endsection