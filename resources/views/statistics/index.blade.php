@extends('layouts.app')
@section('pagetitle', trans('app.statistics'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>{{ trans('app.statistics') }}</h1>
                {!! Breadcrumbs::render('statistics') !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.releases_per_year') }}
                    </div>
                    <div class="card-body" id="rel_div"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        Hall of Kelven...
                    </div>
                    <div class="card-body" id="relkelven_div"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.registrations_per_month') }}
                    </div>
                    <div class="card-body" id="reg_div"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.releases_per_month') }}
                    </div>
                    <div class="card-body" id="relmon_div"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        {{ trans('app.makerchart') }}
                    </div>
                    <div class="card-body" id="makerchart_div" style="height: 488px">

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
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
            <div class="col-sm-6">
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

    {!! $lava->render('AreaChart', 'Registrierungen', 'reg_div') !!}
    {!! $lava->render('AreaChart', 'Kommentare', 'com_div') !!}
    {!! $lava->render('AreaChart', 'Releases', 'rel_div') !!}
    {!! $lava->render('AreaChart', 'ReleasesMon', 'relmon_div') !!}
    {!! $lava->render('AreaChart', 'ForumPosts', 'boardposts_div') !!}
    {!! $lava->render('PieChart', 'MakerChart', 'makerchart_div') !!}
    {!! $lava->render('AreaChart', 'PlayerReleases', 'relkelven_div') !!}
@endsection