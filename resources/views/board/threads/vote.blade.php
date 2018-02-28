@extends('layouts.app')
@section('content')
    @if(Auth::check())
        @if(Auth::user()->id == $thread->user_id or Auth::user()->can('mod-threads'))
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>{{ $thread->title }} - {{ trans('app.create_vote') }}</h1>
                            {!! Breadcrumbs::render('board.vote', $cat, $thread) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (count($errors) > 0)
                            <div class="row">
                                <div class="alert alert-dismissible alert-warning">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <h4>Fehler!</h4>
                                    <p>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong></li>
                                        @endforeach
                                    </ul>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('board.vote.store', [$thread->id]) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    {{ trans('app.create_vote') }}
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="thread_id" id="thread_id" value="{{ $thread->id }}">
                                    <div class="form-group">
                                        <label for="question">{{ trans('app.vote_question') }} *</label>
                                        <input class="form-control" name="question" id="question" value=""/>
                                    </div>
                                    @for($i = 0; $i < 10; $i++)
                                        <div class="form-group" id="row_answer{{ $i }}">
                                            <label for="answer{{ $i }}">{{ trans('app.vote_answer') }}</label>
                                            <input class="form-control" name="answer{{ $i }}" id="answer{{ $i }}" value=""/>
                                            @if($i <= 1)
                                                <span> [<span class="req">req</span>]</span>
                                            @endif
                                        </div>
                                    @endfor
                                </div>
                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary" value="{{ trans('app.submit') }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{ trans('app.login_needed') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @else
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ trans('app.login_needed') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection