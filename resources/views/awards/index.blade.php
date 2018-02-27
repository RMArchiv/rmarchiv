@extends('layouts.app')
@section('pagetitle', trans('app.awards'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.awards') }}
                        @if(Auth::check())
                            <div class="float-right">
                                <a href="{{ route('awards.create') }}" role="button" class="btn btn-primary"><span class="fa fa-plus"></span></a>
                            </div>
                        @endif
                    </h1>
                    {!! Breadcrumbs::render('awards') !!}
                </div>
            </div>
        </div>
        {{ $ayear = null }}
        <div class="row">
            @foreach($awards->groupBy('year') as $cats)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            {{ $cats->first()->year }}
                        </div>
                        <ul class="list-group">
                            @foreach($cats as $aws)
                                <li class="list-group-item">
                                    <span class="text-muted">{{ $aws->awardpage->title }}</span>
                                    <span> • </span>
                                    <a href="{{ action('AwardController@show', $aws->id) }}">{{ $aws->title }}</a>
                                    @if($aws->month <> 0)
                                        <span> • </span>
                                        ({{ trans('app.month.'.$aws->month) }})
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection