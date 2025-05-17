@extends('layouts.app')
@section('pagetitle', trans('app.statistics.title'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>{{ trans('app.statistics.title') }}</h1>
                    {!! Breadcrumbs::render('statistics') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.releases_per_year') }}
                    </div>
                    <div class="card-body" id="release_per_year">
                        <canvas id="releasePerYear"    width="100%"    height="100%"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Hall of Kelven...
                    </div>
                    <div class="card-body" id="relkelven_div"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.registrations_per_month') }}
                    </div>
                    <div class="card-body" id="reg_div"></div>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.releases_per_month') }}
                    </div>
                    <div class="card-body" id="relmon_div"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.makerchart') }}
                    </div>
                    <div class="card-body" id="makerchart_div" style="height: 488px">

                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.comments_per_month') }}
                    </div>
                    <div class="card-body" id="com_div">

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.board_posts_per_month') }}
                    </div>
                    <div class="card-body" id="boardposts_div">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.filestats') }}
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ trans('app.filecategory') }}</th>
                            <th>{{ trans('app.screenshots') }}</th>
                            <th>{{ trans('app.total_file_size') }}</th>
                            <th>{{ trans('app.avg_file_size') }}</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>{{ trans('app.gamefiles') }}</td>
                            <td>{{ number_format($files['games']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['games']['size']) }}</td>
                            <td>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['games']['size'] / $files['games']['count']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('app.screenshots') }}</td>
                            <td>{{ number_format($files['screens']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['screens']['size']) }}</td>
                            <td>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['screens']['size'] / $files['screens']['count']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('app.resources') }}</td>
                            <td>{{ number_format($files['resources']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['resources']['size']) }}</td>
                            <td>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['resources']['size'] / $files['resources']['count']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('app.attachments') }}</td>
                            <td>{{ number_format($files['attach']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['attach']['size']) }}</td>
                            <td>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['attach']['size'] / $files['attach']['count']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ trans('app.logos') }}</td>
                            <td>{{ number_format($files['logos']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['logos']['size']) }}</td>
                            <td>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['logos']['size'] / $files['logos']['count']) }}</td>
                        </tr>
                        <tr>
                            <td style="background-color: #2b542c">{{ trans('app.total') }}</td>
                            <td style="background-color: #2b542c">{{ number_format($files['sum']['count'], 0, ',', '.') }}</td>
                            <td style="background-color: #2b542c">{{ \App\Helpers\MiscHelper::getReadableBytes($files['sum']['size']) }}</td>
                            <td style="background-color: #2b542c">{{ @\App\Helpers\MiscHelper::getReadableBytes($files['sum']['size'] / $files['sum']['count']) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="module">
    window.addEventListener("load", function (event) {
        let rmBack = "#00001a";
        let rmText = "#ffffe0";
        let rmLink = "#ffbf00";
        let rmLinkHover = "#ffdf00";

        let rmBaseM1 = "#112942";
        let rmBase = "#17395c";
        let rmBaseP1 = "#1a4169";
        let rmBaseP2 = "#215285";
        let rmBaseP3 = "#2a6bab";

        const stackedCtx = document.getElementById("releasePerYear");
        let myChart = new Chart(stackedCtx, {
            type: 'line',
            data: {
                labels: {{ Illuminate\Support\Js::from( array_map(function($year) {return $year[0];}, $releasesYear[1])) }},
                datasets: [
                    {
                        label: {{Illuminate\Support\Js::from($releasesYear[0][0])}},
                        data: {{ Illuminate\Support\Js::from( array_map(function($year) {return $year[0];}, $releasesYear[1])) }},
                        backgroundColor: rmLink+"A0",
                        borderColor: rmLink,
                        borderWidth: 2,
                        fill: true,
                    },
                    {
                        label: {{Illuminate\Support\Js::from($releasesYear[0][1])}},
                        data: {{ Illuminate\Support\Js::from( array_map(function($year) {return $year[1];}, $releasesYear[1])) }},
                        backgroundColor: rmBaseP3 + "A0",
                        borderColor: rmBaseP3,
                        borderWidth: 2,
                        fill: true,
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Statistics'
                        }
                    },
                    x: {
                        stacked: true
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    });
    </script>
@endsection