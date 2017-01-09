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
        </div>

        {!! $lava->render('AreaChart', 'Registrierungen', 'reg_div') !!}
        {!! $lava->render('AreaChart', 'Kommentare', 'com_div') !!}
        {!! $lava->render('AreaChart', 'Releases', 'rel_div') !!}
        {!! $lava->render('AreaChart', 'ReleasesMon', 'relmon_div') !!}
    </div>
@endsection