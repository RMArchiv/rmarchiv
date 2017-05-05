@extends('layouts.app')
@section('pagetitle', trans('developer.index.title'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{trans('developer.index.title')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
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
                                    <a class="activated" href="{{ route('developer.index.sorted', ['devname', 'desc']) }}">{{ trans('developer.index.developer') }}</a>
                                @else
                                    <a class="activated reverse" href="{{ route('developer.index.sorted', ['devname', 'asc']) }}">{{ trans('developer.index.developer') }}</a>
                                @endif
                            @else
                                <a class="" href="{{ route('developer.index.sorted', ['devname', 'asc']) }}">{{ trans('developer.index.developer') }}</a>
                            @endif
                        </th>
                        <th>
                            @if($orderby == 'gamecount')
                                @if($direction == 'asc')
                                    <a class="activated" href="{{ route('developer.index.sorted', ['gamecount', 'desc']) }}">{{ trans('developer.index.games') }}</a>
                                @else
                                    <a class="activated reverse" href="{{ route('developer.index.sorted', ['gamecount', 'asc']) }}">{{ trans('developer.index.games') }}</a>
                                @endif
                            @else
                                <a class="" href="{{ route('developer.index.sorted', ['gamecount', 'asc']) }}">{{ trans('developer.index.games') }}</a>
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
                <div class="panel-footer">
                    @if($developer instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        {{ $developer->links('vendor.pagination.bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection