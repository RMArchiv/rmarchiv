@extends('layouts.app')
@section('pagetitle', 'entwicklerlsite')
@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_grouplist'>
            <table id="rmarchiv_creatortable" class='boxtable'>
                <thead>
                <tr class='sortable'>
                    <th>
                        maker
                    </th>
                    <th>
                        spiele
                    </th>
                </tr>
                </thead>
                @foreach($makers as $mk)
                    @if($mk->games()->count() <> 0 and $mk->title <> '')
                        <tr>
                            <td class='groupname'>
                                <a href='{{ route('maker.show', [$mk->id]) }}'>{{ $mk->title }}</a>
                            </td>
                            <td>
                                {{ $mk->games()->count() }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                @if($makers instanceof \Illuminate\Pagination\LengthAwarePaginator )
                    {{ $makers->links('vendor.pagination.gamelist') }}
                @endif
            </table>
        </div>
    </div>
@endsection