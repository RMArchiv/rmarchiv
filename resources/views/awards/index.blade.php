@extends('layouts.app')
@section('pagetitle', trans('awards.title'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('awards.title') }}
                    <div class="pull-right">
                        <a href="{{ route('awards.create') }}" role="button" class="btn btn-primary"><span class="fa fa-plus"></span></a>
                    </div>
                </h1>

                {!! Breadcrumbs::render('awards') !!}
            </div>
        </div>
        {{ $ayear = null }}
        <div class="row">
            @foreach($awards->groupBy('year') as $cats)
                <div class="panel panel-default">
                    <div class="panel-heading">
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
                                    ({{ trans('_misc.month.'.$aws->month) }})
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection