@extends('layouts.app')
@section('pagetitle', 'tagliste')
@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_grouplist'>
            <table id="rmarchiv_creatortable" class='boxtable'>
                <thead>
                <tr class='sortable'>
                    <th>
                        tags
                    </th>
                    <th>
                        spiele
                    </th>
                </tr>
                </thead>
                @foreach($tags as $t)
                    @if($t->tag_relations->count() <> 0 and $t->title <> '')
                        <tr>
                            <td class='groupname'>
                                <a href='{{ url('tags/game',$t->id) }}'>{{ $t->title }}</a>
                            </td>
                            <td>
                                {{ $t->tag_relations->count() }}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
@endsection