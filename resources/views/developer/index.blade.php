@extends('layouts.app')
@section('pagetitle', trans('developer.index.title'))
@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_grouplist'>
            <table id="rmarchiv_creatortable" class='boxtable'>
                <thead>
                <tr class='sortable'>
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
                        {{ $dev->gamecount }}
                    </td>
                </tr>
                    @endif
                @endforeach
                @if($developer instanceof \Illuminate\Pagination\LengthAwarePaginator )
                    {{ $developer->links('vendor.pagination.gamelist') }}
                @endif
            </table>
        </div>
    </div>
@endsection