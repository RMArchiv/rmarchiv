@extends('layouts.app')
@section('pagetitle', $posts->first()->thread->title)
@section('content')

    <script type="module">
        $(document).ready(function(){
            // add button style
            $("[name='poll_bar'").addClass("btn btn-secondary");
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
            <div class="col-md-12">
                <div class="page-header">
                    @if($errors->moveThread->any())
                        <div class="alert alert-warning">
                            @foreach($errors->moveThread->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <div class='btn-toolbar float-end'>
                        <div class='btn-group'>
                            @if(Auth::check())
                                @if(Auth::id() == $posts->first()->thread->user_id or Auth::user()->can('mod-threads'))
                                    @if(!$poll)
                                        <a role="button" class="btn btn-primary" href="{{ route('board.vote.create', ['threadid' => $posts->first()->thread_id])}}"><span class="fa fa-signal fa-rotate-270"></span></a>
                                    @endif
                                @endif
                            @endif
                            @permission(('mod-threads'))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#moveThreadModal" title="{{ trans('app.move_thread') }}" aria-label="{{ trans('app.move_thread') }}">
                                <span class="fa fa-share"></span>
                            </button>
                            @if($posts->first()->thread->closed == 0)
                                <a role="button" class="btn btn-primary" href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 1]) }}"><span class="fa fa-minus-circle"></span></a>
                            @else
                                <a role="button" class="btn btn-primary" href="{{ route('board.thread.switch.close', [$posts->first()->thread->id, 0]) }}"><span class="fa fa-plus-circle"></span></a>
                            @endif
                            @endpermission
                        </div>
                    </div>

                    <h1>{{$posts->first()->thread->title}}</h1>
                    {!! Breadcrumbs::render('thread',$posts->first()->cat, $posts->first()->thread ) !!}
                </div>
            </div>
        </div>
        @permission(('mod-threads'))
        <div class="modal fade" id="moveThreadModal" tabindex="-1" aria-labelledby="moveThreadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('board.thread.move', $posts->first()->thread->id) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="moveThreadModalLabel">{{ trans('app.move_thread') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ trans('app.close') }}"></button>
                        </div>
                        <div class="modal-body">
                            <label for="new_cat_id" class="form-label">{{ trans('app.choose_target_forum') }}</label>
                            <select name="new_cat_id" id="new_cat_id" class="form-select" required>
                                @foreach($moveCategories as $moveCategory)
                                    @if($moveCategory->id != $posts->first()->thread->cat_id)
                                        <option value="{{ $moveCategory->id }}" @if((int) old('new_cat_id') === (int) $moveCategory->id) selected @endif>
                                            {{ $moveCategory->title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('app.cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('app.move_thread') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endpermission
        @if($poll)
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ $poll->title }}
                    </div>
                    <div class="card-body">
                        @foreach($answers as $ans)
                            @if($ans->title != '')
                                <form method="POST" action="{{ action('BoardController@add_vote') }}" id="{{'vote_'.$ans->id}}">
                                    @csrf
                                <input type="hidden" name="poll_id" value="{{ $poll->id }}">
                                <input type="hidden" name="answer_id" value="{{ $ans->id }}">
                                <input type="hidden" name="thread_id" value="{{ $posts->first()->thread_id }}">
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
                                <span class="float-end">{{  round(\App\Helpers\MiscHelper::getPopularity($ans->votes->count(), $votecount)) }}%</span>
                                <div class="progress progress-danger">
                                    <div class="progress-bar" style="width: {{ \App\Helpers\MiscHelper::getPopularity($ans->votes->count(), $votecount) }}%;"></div>
                                </div>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">{{ $posts->links('vendor.pagination.bootstrap-4') }}</div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($posts as $post)
                                <li class="media" id="c{{$post->id}}">
                                    <div class="media-body active">
                                        <div class="media">
                                            <a href="{{ action('UserController@show', $post->user->id) }}">
                                                <img style="width: 48px;" class="me-3" src="//{{ config('app.avatar_path') }}?size=160&gender=male&id={{ $post->user->id }}">
                                            </a>
                                            <div class="media-body">
                                                {!! \App\Helpers\InlineBoxHelper::GameBox($post->content_html) !!}
                                                <br>
                                                <small class="text-muted"><a href='{{ url('users', $post->user->id) }}' class='user'>{{ $post->user->name }}</a><span> • </span><a href='{{ route('board.thread.show', [$post->thread->id]) }}#c{{ $post->id }}'><time datetime='{{ $post->created_at }}' title='{{ $post->created_at }}'>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</time></a>
                                                    @if($post->updated_at)
                                                        <span> • </span>{{ trans('app.edited_at') }} {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}
                                                    @endif
                                                    @if(Auth::check())
                                                        @if(Auth::id() == $post->user->id or Auth::user()->can('mod-threads'))
                                                            <div class="float-end">
                                                                <a href="{{ route('board.post.edit', [$post->thread->id, $post->id]) }}" data-rel="popup">{{ trans('app.edit') }}</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <span class="float-end me-2">
                                                        @include('reports._partials.report-button', [
                                                            'reportType' => 'board_post',
                                                            'reportId' => $post->id,
                                                            'reportLabel' => $posts->first()->thread->title,
                                                        ])
                                                    </span>
                                                </small>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">{{ $posts->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                @if(Auth::check())
                    <div class="card">
                        <div class="card-header">
                            {{ trans('app.create_thread') }}
                        </div>
                        <div class="card-body">
                            @if($post->thread->closed == 0)
                                <form method="POST" action="{{ action('BoardController@store_post', $posts->first()->thread->id) }}">
                                    @csrf
                                <input type='hidden' name='catid' value='{{ $posts->first()->cat->id }}'>
                                <div class='content'>
                                    @include('_partials.markdown_editor')
                                    <div><a href='#'>{{ trans('app.markdown_is_usable_here') }}</a></div>
                                </div>
                                <div class='foot'>
                                    <button class="btn btn-primary" id='submit'>{{ trans('app.submit') }}</button>
                                </div>
                                </form>
                            @else
                                <h2>{{ trans('app.thread_is_closed') }}</h2>
                                {{ trans('app.thread_is_closed_you_cant_post') }}
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            {{ trans('app.login_needed_to_post') }}
                        </div>
                        <div class="card-body">
                            {{ trans('app.login_needed_to_post') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
