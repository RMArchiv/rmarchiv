@extends('layouts.app')
@section('pagetitle', 'entwicklerlsite')
@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_grouplist'>
            <table id="rmarchiv_creatortable" class='boxtable'>
                <thead>
                <tr class='sortable'>
                    <th>
                        @if($orderby == 'devname')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('developer.index.sorted', ['devname', 'desc']) }}">entwickler</a>
                            @else
                                <a class="activated reverse" href="{{ route('developer.index.sorted', ['devname', 'asc']) }}">entwickler</a>
                            @endif
                        @else
                            <a class="" href="{{ route('developer.index.sorted', ['devname', 'asc']) }}">entwickler</a>
                        @endif
                    </th>
                    <th>
                        @if($orderby == 'gamecount')
                            @if($direction == 'asc')
                                <a class="activated" href="{{ route('developer.index.sorted', ['gamecount', 'desc']) }}">spiele</a>
                            @else
                                <a class="activated reverse" href="{{ route('developer.index.sorted', ['gamecount', 'asc']) }}">spiele</a>
                            @endif
                        @else
                            <a class="" href="{{ route('developer.index.sorted', ['gamecount', 'asc']) }}">spiele</a>
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
            </table>
        </div>
    </div>
@endsection