@extends('layouts.app')
@section('pagetitle', $posts->first()->thread->title)
@section('content')

    <script>
        $(document).ready(function(){
            // add button style
            $("[name='poll_bar'").addClass("btn btn-default");
            // Add button style with alignment to left with margin.
            $("[name='poll_bar'").css({"text-align":"left","margin":"5px"});

            //loop
            $("[name='poll_bar'").each(
                function(i){
                    //get poll value
                    var bar_width = (parseFloat($("[name='poll_val'").eq(i).text())/2).toString();
                    bar_width = bar_width + "%"; //add percentage sign.
                    //set bar button width as per poll value mention in span.
                    $("[name='poll_bar'").eq(i).width(bar_width);

                    //Define rules.
                    var bar_width_rule = parseFloat($("[name='poll_val'").eq(i).text());
                    if(bar_width_rule >= 50){$("[name='poll_bar'").eq(i).addClass("btn btn-sm btn-success")}
                    if(bar_width_rule <  50){$("[name='poll_bar'").eq(i).addClass("btn btn-sm btn-warning")}
                    if(bar_width_rule <= 10){$("[name='poll_bar'").eq(i).addClass("btn btn-sm btn-danger")}

                    //Hide dril down divs
                    $("#" + $("[name='poll_bar'").eq(i).text()).hide();
                });
        });
    </script>
    <div class="container">
        <div class="row">
            <div class="page-header">
                @permission(('mod-threads'))
                <div class='btn-toolbar pull-right'>
                    <div class='btn-group'>
                        @if(Auth::check())
                            @if(Auth::id() == $posts->first()->thread->user_id or Auth::user()->can('mod-threads'))
                                @if(!$poll)
                                    <a role="button" class="btn btn-primary" href="{{ route('board.vote.create', ['threadid' => $posts->first()->thread_id])}}"><span class="fa fa-signal fa-rotate-270"></span></a>
                                @endif
                            @endif
                        @endif
                        @if($posts->first()->thread->closed == 0)
                            <a role="button" class="btn btn-primary" href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 1]) }}"><span class="fa fa-minus-circle"></span></a>
                        @else
                            <a role="button" class="btn btn-primary" href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 0]) }}"><span class="fa fa-plus-circle"></span></a>
                        @endif
                    </div>
                </div>
                @endpermission
                <h1>{{$posts->first()->thread->title}}</h1>
                {!! Breadcrumbs::render('thread',$posts->first()->cat, $posts->first()->thread ) !!}
            </div>
        </div>
        @if($poll)
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $poll->title }}
                </div>
                <div class="panel-body">
                    @foreach($answers as $ans)
                        @if($ans->title != '')
                            {!! Form::open(['action' => ['BoardController@add_vote'], 'method' => 'POST', 'id' => 'vote_'.$ans->id]) !!}
                            {!! Form::hidden('poll_id', $poll->id) !!}
                            {!! Form::hidden('answer_id', $ans->id) !!}
                            {!! Form::hidden('thread_id', $posts->first()->thread_id) !!}
                            <strong>
                                @if($votes)
                                    @if($votes->count() != 0 and $votes->first()->answer_id == $ans->id)
                                        <span class="text-muted">{{ $ans->title }}</span>
                                    @else
                                        <a href="javascript:{}" onclick="document.getElementById('vote_{{$ans->id}}').submit(); return false;">{{ $ans->title }}</a>
                                    @endif
                                @else
                                    {{ $ans->title }}
                                @endif
                            </strong>
                            <span class="pull-right">{{  round(\App\Helpers\MiscHelper::getPopularity($ans->votes->count(), $votecount)) }}%</span>
                            <div class="progress progress-danger">
                                <div class="progress-bar" style="width: {{ \App\Helpers\MiscHelper::getPopularity($ans->votes->count(), $votecount) }}%;"></div>
                            </div>
                            {!! Form::close() !!}
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $posts->links('vendor.pagination.bootstrap-4') }}</div>
                <div class="panel-body">
                    <ul class="media-list">
                        @foreach($posts as $post)
                        <li class="media" id="c{{$post->id}}">
                            <div class="media-body active">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img width="32px" class="media-object img-rounded" src="http://ava.rmarchiv.de/?size=160&gender=male&id={{ $post->user->id }}">
                                    </a>
                                    <div class="media-body">
                                        {!! \App\Helpers\InlineBoxHelper::GameBox($post->content_html) !!}
                                        <br>
                                        <small class="text-muted"><a href='{{ url('users', $post->user->id) }}' class='user'>{{ $post->user->name }}</a><span> • </span><a href='{{ route('board.thread.show', [$post->thread->id]) }}#c{{ $post->id }}'><time datetime='{{ $post->created_at }}' title='{{ $post->created_at }}'>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</time></a>
                                            @if($post->updated_at)
                                                <span> • </span>{{ trans('board.threads.show.edited') }} {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}
                                            @endif
                                            @if(Auth::check())
                                                @if(Auth::id() == $post->user->id or Auth::user()->can('mod-threads'))
                                                    <div class="pull-right">
                                                        <a href="{{ route('board.post.edit', [$post->thread->id, $post->id]) }}" data-rel="popup">{{ trans('board.threads.show.edit') }}</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </small>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="panel-footer">{{ $posts->links('vendor.pagination.bootstrap-4') }}</div>
            </div>
        </div>
        <div class="row">
            @if(Auth::check())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('board.threads.show.create_post') }}
                    </div>
                    <div class="panel-body">
                        @if($post->thread->closed == 0)
                            {!! Form::open(['action' => ['BoardController@store_post', $posts->first()->thread->id], 'id' => 'frmBBSPost']) !!}
                            <input type='hidden' name='catid' value='{{ $posts->first()->cat->id }}'>
                            <div class='content'>
                                @include('_partials.markdown_editor')
                                <div><a href='#'>{{ trans('board.threads.show.markdown') }}</a></div>
                            </div>
                            <div class='foot'>
                                <input type='submit' value='Submit' id='submit'></div>
                            {!! Form::close() !!}
                        @else
                            <h2>{{ trans('board.threads.show.thread_closed') }}</h2>
                            {{ trans('board.threads.show.thread_closed_msg') }}
                        @endif
                    </div>
                </div>
            @else
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('board.threads.show.no_login_title') }}
                    </div>
                    <div class="panel-body">
                        {{ trans('board.threads.show.no_login_title') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection