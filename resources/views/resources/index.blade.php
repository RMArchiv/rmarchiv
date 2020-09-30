@extends('layouts.app')
@section('pagetitle', trans('app.resources_overview'))
@section('content')
    @include('resources._partials.nav')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.resources_overview') }}</h1>
                    {!! Breadcrumbs::render('ressources') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">{{ trans('app.statistics') }}</div>
                <table class="table table-striped table-hover">
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
                                    <img src='/assets/rate_up.gif' alt='{{ trans('app.rate_up') }}'/>
                                @elseif($avg == 0)
                                    <img src='/assets/rate_neut.gif' alt='{{ trans('app.rate_neut') }}'/>
                                @elseif($avg < 0)
                                    <img src='/assets/rate_down.gif' alt='{{ trans('app.rate_down') }}'/>
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
        </div>
    </div>

@endsection