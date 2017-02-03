@extends('layouts.app')
@section('pagetitle', 'historie')
@section('content')
    <div id="content">
        <div class='rmarchivtbl' id='rmarchivbox_grouplist'>
            @if($activity->count() != 0)
            <table id="rmarchiv_creatortable" class='boxtable'>
                <thead>
                <tr class='sortable'>
                    <th>
                        aktivität
                    </th>
                    <th>
                        datum
                    </th>
                    <th>
                        aktivität von
                    </th>
                    <th>
                        änderung
                    </th>
                </tr>
                </thead>
                @foreach($activity as $a)
                        <tr>
                            <td>
                                {{ $a->description }}
                            </td>
                            <td>
                                {{ $a->created_at }}
                            </td>
                            <td>
                                <a href="{{ url('/user', $a->causer->id) }}" class="usera" title="{{ $a->causer->name }}">
                                    <img src="http://ava.rmarchiv.de/?gender=male&amp;id={{ $a->causer->id }}" alt="{{ $a->causer->name }}" class="avatar">
                                </a> <a href="{{ url('/user', $a->causer->user_id) }}" class="user">{{ $a->causer->name }}</a>
                            </td>
                            <td>
                                @if($a->description == 'updated')
                                    {{ implode(', ', array_keys(\App\Helpers\MiscHelper::array_diff_assoc_recursive($a->changes['old'], $a->changes['attributes']))) }}
                                @endif
                            </td>
                        </tr>
                @endforeach
            </table>
            @else
                Hier wurde noch nichts verändert =)
            @endif
        </div>
    </div>
@endsection