@extends('layouts.app')
@section('pagetitle', trans('app.developers'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{trans('app.developers')}}</h1>
                {!! Breadcrumbs::render('developers') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if($developer instanceof \Illuminate\Pagination\LengthAwarePaginator )
                            {{ $developer->links('vendor.pagination.bootstrap-4') }}
                        @endif
                    </div>
                    <table class='table table-striped'>
                        <thead>
                        <tr class="active">
                            <th>
                                @if($orderby == 'devname')
                                    @if($direction == 'asc')
                                        <a class="activated" href="{{ route('developer.index.sorted', ['devname', 'desc']) }}">{{ trans('app.developer') }}</a>
                                    @else
                                        <a class="activated reverse" href="{{ route('developer.index.sorted', ['devname', 'asc']) }}">{{ trans('app.developer') }}</a>
                                    @endif
                                @else
                                    <a class="" href="{{ route('developer.index.sorted', ['devname', 'asc']) }}">{{ trans('app.developer') }}</a>
                                @endif
                            </th>
                            <th>
                                @if($orderby == 'gamecount')
                                    @if($direction == 'asc')
                                        <a class="activated" href="{{ route('developer.index.sorted', ['gamecount', 'desc']) }}">{{ trans('app.games') }}</a>
                                    @else
                                        <a class="activated reverse" href="{{ route('developer.index.sorted', ['gamecount', 'asc']) }}">{{ trans('app.games') }}</a>
                                    @endif
                                @else
                                    <a class="" href="{{ route('developer.index.sorted', ['gamecount', 'asc']) }}">{{ trans('app.games') }}</a>
                                @endif
                            </th>
                        </tr>
                        </thead>
                        @foreach($developer as $dev)
                            @if($dev->gamecount <> 0 and $dev->devname <> '')
                                <tr>
                                    <td class='groupname'>
                                        <a href='{{ url('developer',$dev->devid) }}'>{{ $dev->devname }}</a>
                                    </td>
                                    <td>
                                        <span class="badge">{{ $dev->gamecount }}</span>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </table>
                    <div class="card-footer">
                        @if($developer instanceof \Illuminate\Pagination\LengthAwarePaginator )
                            {{ $developer->links('vendor.pagination.bootstrap-4') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection