@extends('layouts.app')
@section('content')
    <div id="content">
        <div style="width: 50%; float: left;">
            <div class="rmarchivtbl" style="width: 95%">
                <h2>Releases pro Jahr</h2>
                <div id="rel_div"></div>
                <div class='foot'>=D</div>
            </div>
            <div class="rmarchivtbl" style="width: 95%">
                <h2>Registrierungen pro Monat</h2>
                <div id="reg_div"></div>
                <div class='foot'>=D</div>
            </div>
            <div class="rmarchivtbl" style="width: 95%">
                <h2>Datei Statistiken</h2>
                <div class="content">
                    <table id="rmarchivbox_bbslist" class="boxtable pagedtable">
                        <thead>
                            <tr>
                                <th>kategorie</th>
                                <th>anzahl</th>
                                <th>gesamtgröße</th>
                                <th>durchschnittsgröße</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>games</td>
                            <td>{{ number_format($files['games']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['games']['size']) }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['games']['size'] / $files['games']['count']) }}</td>
                        </tr>
                        <tr>
                            <td>screenshots</td>
                            <td>{{ number_format($files['screens']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['screens']['size']) }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['screens']['size'] / $files['screens']['count']) }}</td>
                        </tr>
                        <tr>
                            <td>resources</td>
                            <td>{{ number_format($files['resources']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['resources']['size']) }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['resources']['size'] / $files['resources']['count']) }}</td>
                        </tr>
                        <tr>
                            <td>inline-attachments</td>
                            <td>{{ number_format($files['attach']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['attach']['size']) }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['attach']['size'] / $files['attach']['count']) }}</td>
                        </tr>
                        <tr>
                            <td>logos</td>
                            <td>{{ number_format($files['logos']['count'], 0, ',', '.') }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['logos']['size']) }}</td>
                            <td>{{ \App\Helpers\MiscHelper::getReadableBytes($files['logos']['size'] / $files['logos']['count']) }}</td>
                        </tr>
                        <tr>
                            <td style="background-color: #2b542c">summe</td>
                            <td style="background-color: #2b542c">{{ number_format($files['sum']['count'], 0, ',', '.') }}</td>
                            <td style="background-color: #2b542c">{{ \App\Helpers\MiscHelper::getReadableBytes($files['sum']['size']) }}</td>
                            <td style="background-color: #2b542c">{{ \App\Helpers\MiscHelper::getReadableBytes($files['sum']['size'] / $files['sum']['count']) }}</td>
                        </tr>
                    </table>

                </div>
                <div class='foot'>=D</div>
            </div>
        </div>
        <div style="width: 50%; float: left;">
            <div class="rmarchivtbl" style="width: 95%">
                <h2>Releases pro Monat</h2>
                <div id="relmon_div"></div>
                <div class='foot'>=D</div>
            </div>
            <div class="rmarchivtbl" style="width: 95%">
                <h2>Kommentare pro Monat</h2>
                <div id="com_div"></div>
                <div class='foot'>=D</div>
            </div>
            <div class="rmarchivtbl" style="width: 95%">
                <h2>Forenposts pro Monat</h2>
                <div id="boardposts_div"></div>
                <div class='foot'>=D</div>
            </div>
        </div>

        {!! $lava->render('AreaChart', 'Registrierungen', 'reg_div') !!}
        {!! $lava->render('AreaChart', 'Kommentare', 'com_div') !!}
        {!! $lava->render('AreaChart', 'Releases', 'rel_div') !!}
        {!! $lava->render('AreaChart', 'ReleasesMon', 'relmon_div') !!}
        {!! $lava->render('AreaChart', 'ForumPosts', 'boardposts_div') !!}
    </div>
@endsection