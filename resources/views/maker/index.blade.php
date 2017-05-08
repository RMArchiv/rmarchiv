@extends('layouts.app')
@section('pagetitle', 'entwickler')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>entwickler</h1>
                {!! Breadcrumbs::render('developers') !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($makers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        {{ $makers->links('vendor.pagination.gamelist') }}
                    @endif
                </div>
                <ul class="list-group">
                    @foreach($makers as $mk)
                        @if($mk->games()->count() <> 0 and $mk->title <> '')
                            <li class="list-group-item">
                                <a href='{{ route('maker.show', [$mk->id]) }}'>{{ $mk->title }}</a>
                                <div class="pull-right">
                                    <span class="badge">{{ $mk->games()->count() }}</span>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="panel-footer">
                    @if($makers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        {{ $makers->links('vendor.pagination.gamelist') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection