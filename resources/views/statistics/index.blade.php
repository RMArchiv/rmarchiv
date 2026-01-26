@php
function randomHexColor($length = 6) {
    return str(bin2hex(random_bytes($length / 2)));
}
@endphp

@extends('layouts.app')
@section('pagetitle', trans('app.statistics.title'))
@section('content')
@vite('resources/assets/js/chart.js')
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
                        <a href="/developer/6">Hall of Kelven...</a>
                    </div>
                    <div class="card-body" id="relkelven_div">
                        <canvas id="releasePerYearKelven"    width="100%"    height="100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-none">
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
                    <div class="card-body" id="makerchart_div" style="display:flex,max-height:500px">
                        <canvas id="releasesPerMaker"    width="100%"    height="100%"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.filestats') }}
                    </div>
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th><small>{{ trans('app.filecategory') }}</small></th>
                            <th><small>{{ trans('app.amount') }}</small></th>
                            <th><small>{{ trans('app.total_file_size') }}</small></th>
                            <th><small>{{ trans('app.avg_file_size') }}</small></th>
                        </tr>
                        </thead>
                        <tr>
                            <td><small>{{ trans('app.gamefiles') }}</small></td>
                            <td><small>{{ number_format($files['games']['count'], 0, ',', '.') }}</small></td>
                            <td><small>{{ \App\Helpers\MiscHelper::getReadableBytes($files['games']['size']) }}</small></td>
                            <td><small>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['games']['size'] / $files['games']['count']) }}</small></td>
                        </tr>
                        <tr>
                            <td><small>{{ trans('app.screenshots') }}</small></td>
                            <td><small>{{ number_format($files['screens']['count'], 0, ',', '.') }}</small></td>
                            <td><small>{{ \App\Helpers\MiscHelper::getReadableBytes($files['screens']['size']) }}</small></td>
                            <td><small>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['screens']['size'] / $files['screens']['count']) }}</small></td>
                        </tr>
                        <tr>
                            <td><small>{{ trans('app.resources') }}</small></td>
                            <td><small>{{ number_format($files['resources']['count'], 0, ',', '.') }}</small></td>
                            <td><small>{{ \App\Helpers\MiscHelper::getReadableBytes($files['resources']['size']) }}</small></td>
                            <td><small>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['resources']['size'] / $files['resources']['count']) }}</small></td>
                        </tr>
                        <tr>
                            <td><small>{{ trans('app.attachments') }}</small></td>
                            <td><small>{{ number_format($files['attach']['count'], 0, ',', '.') }}</small></td>
                            <td><small>{{ \App\Helpers\MiscHelper::getReadableBytes($files['attach']['size']) }}</small></td>
                            <td><small>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['attach']['size'] / $files['attach']['count']) }}</small></td>
                        </tr>
                        <tr>
                            <td><small>{{ trans('app.logos') }}</small></td>
                            <td><small>{{ number_format($files['logos']['count'], 0, ',', '.') }}</small></td>
                            <td><small>{{ \App\Helpers\MiscHelper::getReadableBytes($files['logos']['size']) }}</small></td>
                            <td><small>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['logos']['size'] / $files['logos']['count']) }}</small></td>
                        </tr>
                        <tr>
                            <td style="background-color: #2b542c"><small>{{ trans('app.total') }}</small></td>
                            <td style="background-color: #2b542c"><small>{{ number_format($files['sum']['count'], 0, ',', '.') }}</small></td>
                            <td style="background-color: #2b542c"><small>{{ \App\Helpers\MiscHelper::getReadableBytes($files['sum']['size']) }}</small></td>
                            <td style="background-color: #2b542c"><small>{{ @\App\Helpers\MiscHelper::getReadableBytes($files['sum']['size'] / $files['sum']['count']) }}</small></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <a>Maker Timeline</a>
                    </div>
                    <div class="d-flex justify-content-center" style="max-height: 90vh">
                        <div class="card-body p-0 d-flex justify-content-center" id="relkelven_div" style="max-width: 760px">
                            <canvas id="makerTimeline"    width="100%"    height="100%"></canvas>
                        </div>
                    </div>
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

        Chart.defaults.color = rmText;

        const perYearCtx = document.getElementById("releasePerYear");
        let releaseChart = new Chart(perYearCtx, {
            type: 'line',
            data: {
                labels: {{ Illuminate\Support\Js::from( array_map(function($year) {return $year[0];}, $releasesYear[1])) }},
                datasets: [
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
                            text: "{{trans("app.amount")}}"
                        }
                    },
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: "{{trans("app.release_date")}}"
                        }
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

        const gamesPerYearKelvenCtx = document.getElementById("releasePerYearKelven");
        let kelvenChart = new Chart(gamesPerYearKelvenCtx, {
            type: 'line',
            data: {
                labels: {{ Illuminate\Support\Js::from( array_map(function($release) {return $release->year;}, $releasesYearKelven) ) }},
                datasets: [
                    {
                        label: {{ Illuminate\Support\Js::from( array_map(function($release) {return $release->year;}, $releasesYearKelven) ) }},
                        data: {{ Illuminate\Support\Js::from( array_map(function($release) {return $release->count;}, $releasesYearKelven) ) }},
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
                            text: "{{trans("app.amount")}}"
                        }
                    },
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: "{{trans("app.release_date")}}"
                        }
                    }
                },
                layout: {
                    color:"red",
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: {
                        position: 'none',
                    },
                }
            }
        });
        const makerCount = {{count($makerReleases[0])}};

        const gamesPerMakerCtx = document.getElementById("releasesPerMaker");
        let makerChart = new Chart(gamesPerMakerCtx, {
            type: 'pie',
            spacing: 500,
            data: {
                labels: {{ Illuminate\Support\Js::from( $makerReleases[0] ) }},

                datasets: [
                    {
                        data: {{ Illuminate\Support\Js::from( $makerReleases[1] ) }},
                        backgroundColor: Array.from(Array(makerCount).keys()).map(()=>"#"+randomHexColor() + "A0"),
                        borderColor: rmBaseP3,
                        borderWidth: 0,
                        fill: true,
                    },
                ]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });


        const makerTimeline = document.getElementById("makerTimeline");

        let makerTimelineChart = new Chart(makerTimeline, {
            type: 'line',
            data: {

                labels: {{ json_encode(
                    array_values(array_unique(array_reduce(
                        array: array_map( function($maker) {
                            return array_map( function($year) {
                                    return $year->year;
                                },
                                $maker->toArray()
                            );
                        },
                        $makerPerYear
                        ),
                        callback: function($carry, $item) {return array_merge($carry, $item);},
                        initial: array()
                    )))
                ) }},
                datasets:
                    {{Illuminate\Support\Js::from(array_values(array_map(function($makerData) {
                        return array(
                        "label" => ($makerData[0]->title),
                        "data" => ( array_map(function($year) {return $year->count;}, $makerData->toArray())),
                        'backgroundColor' => "#" . randomHexColor(),
                        'borderColor'=> 'rmBaseP3',
                        'borderWidth'=> '2',
                        'fill'=> true
                        );
                    }, ($makerPerYear))))

                    }}


            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true,
                        title: {
                            display: true,
                            text: "{{trans("app.amount")}}"
                        }
                    },
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: "{{trans("app.release_date")}}"
                        }
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
                        labels: {
                            font: {
                                size:9
                            }
                        }
                    },
                }
            }
        });
    });



    </script>
@endsection