@extends('layouts.app')
@section('pagetitle', 'entwicklerlsite')
@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_grouplist'>
            <table id="rmarchiv_creatortable" class='boxtable'>
                <thead>
                <th>entwickler</th>
                <th>games</th>
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