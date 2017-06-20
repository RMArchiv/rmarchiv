@extends('layouts.app')
@section('content')
    @if(Auth::check())
        @if(Auth::user()->id == $thread->user_id or Auth::user()->can('mod-threads'))
            <div id="content">
                <form action="{{ route('board.vote.store', [$thread->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="rmarchivtbl" id="rmarchivbox_submitprod" style="width: 60%">
                        <h2>{{ trans('app.create_vote') }}</h2>

                        @if (count($errors) > 0))
                        <div class="rmarchivtbl errorbox">
                            <h2>{{ trans('app.create_vote_error') }}</h2>
                            <div class="content">
                                @foreach ($errors->all() as $error)
                                    <strong>{{ $error }}</strong>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="content">
                            <input type="hidden" name="thread_id" id="thread_id" value="{{ $thread->id }}">

                            <div class="formifier">
                                <div class="row" id="row_question">
                                    <label for="question">{{ trans('app.vote_question') }}</label>
                                    <input name="question" id="question" value=""/>
                                    <span> [<span class="req">req</span>]</span>
                                </div>
                                @for($i = 0; $i < 10; $i++)
                                    <div class="row" id="row_answer{{ $i }}">
                                        <label for="answer{{ $i }}">{{ trans('app.vote_answer') }}</label>
                                        <input name="answer{{ $i }}" id="answer{{ $i }}" value=""/>
                                        @if($i <= 1)
                                            <span> [<span class="req">req</span>]</span>
                                        @endif
                                    </div>
                                @endfor
                            </div>

                        </div>
                        <div class="foot">
                            <input type="submit" value="{{ trans('app.submit') }}">
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div id="content">
                <div class="rmarchivtbl">
                    {{ trans('app.login_needed') }}
                </div>
            </div>
        @endif

    @else
        <div id="content">
            <div class="rmarchivtbl">
                {{ trans('app.login_needed') }}
            </div>
        </div>
    @endif
@endsection