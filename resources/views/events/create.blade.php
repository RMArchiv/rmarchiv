@extends('layouts.app')
@section('pagetitle', 'event erstellen')
@section('content')
    <div id="content">
        <form action="{{ action('EventController@store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="rmarchivtbl container" id="rmarchivbox_submitnews">
                <h2>event anlegen</h2>

                @if (count($errors) > 0))
                <div class="rmarchivtbl errorbox">
                    <h2>event konnte nicht angelegt werden</h2>
                    <div class="content">
                        @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="content">
                    <div class="formifier">
                        <div class="row" id="row_type">
                            <label for="title">titel:</label>
                            <input class="form-control" name="title" id="title" value="" placeholder="Opel-Treff 2004"/>
                        </div>
                        <div class="mb-3"> [<span class="req">req</span>]</div>
                        <div class="row" id="row_desc">
                            <label for="desc">beschreibung:</label>
                            <textarea class="form-control" name="desc" id="desc" maxlength="9999" rows="10" placeholder="eventbeschreibung"></textarea>
                        </div>
                        <div class="mb-3"> [<span class="req">req</span>]</div>
                        <div class="input-group" id="row_start">
                            <label class="input-group-text" for="start">beginn des events:</label>
                            <input class="start form-control" name="start" id="start" value="" type="datetime-local"/>
                        </div>
                        <div class="mb-3"> [<span class="req">req</span>]</div>
                        <div class="input-group" id="row_end">
                            <label class="input-group-text" for="end">ende des events:</label>
                            <input class="end form-control" name="end" id="end" value="" type="datetime-local"/>
                        </div>
                        <div class="mb-3"> [<span class="req">req</span>]</div>
                    </div>
                </div>
                <h2>anmeldungseinstellungen</h2>
                <div class="content">
                    <div class="formifier mb-3">
                        <div class="row" id="row_slots">
                            <label for="slots">anzahl der möglichen anmeldungen:</label>
                            <input name="slots" id="slots" value="" placeholder="anzahl (0 = unbegrenzt)" class="form-control"/>
                            <span class="mb-3"> [<span class="req">req</span>]</span>
                        </div>
                        <div class="row mb-3" id="row_price">
                            <label for="price">anmeldegebühr:</label>
                            <input name="price" id="price" value="" placeholder="Betrag in €" class="form-control"/>
                        </div>

                        <div class="form-check" id="row_reg_allowed">
                            <label for="reg_allowed" class="form-check-label">anmeldung geöffnet:</label>
                            <input type="checkbox" name="reg_allowed" id="reg_allowed" class="form-check-input"/>
                            wenn deaktiviert, werden untere zeiten ignoriert!
                        </div>
                        <div class="row mb-2" id="row_reg_start">
                            <label for="reg_start">beginn des anmeldezeitraumes:</label>
                            <input class="reg_start form-control form-control-sm" name="reg_start" id="reg_start" value="" type="date"/>
                        </div>
                        <div class="row mb-2" id="row_reg_end">
                            <label for="reg_end">ende des anmeldezeitraumes:</label>
                            <input class="reg_end form-control form-control-sm" name="reg_end" id="reg_end" value="" type="date"/>
                        </div>
                    </div>
                </div>
                <div class="foot">
                    <input class="btn btn-primary" type="submit" value="änderungen speichern">
                </div>
            </div>
        </form>
    </div>
@endsection