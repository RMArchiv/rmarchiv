@extends('layouts.app')
@section('content')
    @include('resources._partials.nav')
    <div id="content">
        @include('resources.sfx._partials.nav')
        <h1>{{ trans('resources.sfx.index.title') }}</h1>
        <table id='rmarchiv_prodlist' class='boxtable pagedtable'>
            <thead>
            <tr class='sortable'>
                <th>{{ trans('resources.sfx.index.type') }}</th>
                <th>{{ trans('resources.sfx.index.category') }}</th>
                <th>{{ trans('resources.sfx.index.by') }}</th>
                <th>{{ trans('resources.sfx.index.created_at') }}</th>
                <th>{{ trans('resources.sfx.index.res_title') }}</th>
                <th>{{ trans('resources.sfx.index.content_type') }}</th>
                <th><img src='/assets/rate_up.gif' alt='{{ trans('resources.sfx.index.voteup') }}' /></th>
                <th><img src='/assets/rate_down.gif' alt='{{ trans('resources.sfx.index.votedown') }}' /></th>
                <th>{{ trans('resources.sfx.index.avg') }}</th>
                <th>{{ trans('resources.sfx.index.popularity') }}</th>
                <th>{{ trans('resources.sfx.index.comments') }}</th>
            </tr>
            </thead>

            @foreach($resources as $res)
                <tr>
                    <td>{{ $res->restype }}</td>
                    <td>{{ $res->rescat }}</td>
                    <td class=>{{ $res->username }}</td>
                    <td class='date'><time datetime='{{ $res->rescreatedat }}' title='{{ $res->rescreatedat }}'>{{ \Carbon\Carbon::parse($res->rescreatedat)->diffForHumans() }}</time></td>
                    <td><a href="{{ route('resources.show', [$res->restype, $res->rescat, $res->resid]) }}">{{ $res->restitle }}</a></td>
                    <td>{{ $res->contenttype }}</td>
                    <td class='votes'>{{ $res->voteup or 0 }}</td>
                    <td class='votes'>{{ $res->votedown or 0 }}</td>
                    @php $avg = @(($res->voteup - $res->votedown) / ($res->voteup + $res->votedown)) @endphp
                    <td class='votes'>{{ number_format($avg, 2) }}&nbsp;
                        @if($avg > 0)
                            <img src='/assets/rate_up.gif' alt='up' />
                        @elseif($avg == 0)
                            <img src='/assets/rate_neut.gif' alt='neut' />
                        @elseif($avg < 0)
                            <img src='/assets/rate_down.gif' alt='down' />
                        @endif
                    </td>
                    @php
                        $perc = \App\Helpers\MiscHelper::getPopularity($res->commentcount, $commentsmax);
                    @endphp
                    <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ number_format($perc, 2) }}%'><span>{{ $perc }}</span></div></td>
                    <td>{{ $res->commentcount }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection